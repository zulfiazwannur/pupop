<?php

namespace App\Http\Controllers;

use App\Models\Penukaran;
use App\Models\Produk;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

/** Penukaran poin dengan produk: dari keranjang -> konfirmasi -> sukses. */
class PenukaranController extends Controller
{
    private const BERAT_PER_ITEM = 0.6; // kg, estimasi seperti pada desain awal

    /** Halaman pilih produk (tukar). */
    public function index(Request $request): View
    {
        $user = $request->user();

        return view('pages.tukar', [
            'produkList' => Produk::orderBy('id')->get(),
            'keranjang' => KeranjangController::payload($user),
            'poin' => $user->poin,
        ]);
    }

    /** Halaman konfirmasi (tukar1): daftar produk dari keranjang di database. */
    public function konfirmasi(Request $request): View|RedirectResponse
    {
        $user = $request->user();
        $keranjang = KeranjangController::payload($user);

        if ($keranjang['total_item'] === 0) {
            return redirect()->route('tukar')->with('status', 'Keranjang masih kosong. Tambah minimal 1 barang terlebih dahulu!');
        }

        return view('pages.tukar1', [
            'keranjang' => $keranjang,
            'berat' => round($keranjang['total_item'] * self::BERAT_PER_ITEM, 1),
            'lokasi' => $user->mitraPilihan,
            'poin' => $user->poin,
        ]);
    }

    /** Proses penukaran. Memakai transaksi: poin, riwayat, dan keranjang berubah bersamaan atau tidak sama sekali. */
    public function store(Request $request): RedirectResponse
    {
        $user = $request->user();

        if (! $user->mitra_pilihan_id || ! $user->mitraPilihan?->aktif) {
            return redirect()->route('tukar1')->with('status', 'Pilih lokasi mitra terlebih dahulu.');
        }

        $hasil = DB::transaction(function () use ($user) {
            // kunci baris user supaya dua permintaan bersamaan tidak membuat poin minus
            $u = $user->newQuery()->lockForUpdate()->find($user->id);
            $keranjang = $u->keranjang()->with('produk')->get();

            if ($keranjang->isEmpty()) {
                return 'Keranjang masih kosong.';
            }

            $total = $keranjang->sum(fn ($k) => $k->qty * $k->produk->poin);
            if ($u->poin < $total) {
                return "Poin tidak cukup. Dibutuhkan {$total} poin, poin Anda {$u->poin}.";
            }

            $tukar = Penukaran::create([
                'user_id' => $u->id,
                'lokasi_mitra_id' => $u->mitra_pilihan_id,
                'jumlah_item' => $keranjang->sum('qty'),
                'total_poin' => $total,
            ]);

            foreach ($keranjang as $k) {
                $tukar->item()->create([
                    'produk_id' => $k->produk_id,
                    'nama' => $k->produk->nama,
                    'kategori' => $k->produk->kategori,
                    'qty' => $k->qty,
                    'poin_satuan' => $k->produk->poin,
                ]);
            }

            $u->decrement('poin', $total);
            $u->keranjang()->delete();

            return $tukar;
        });

        if (is_string($hasil)) {
            return redirect()->route('tukar1')->with('status', $hasil);
        }

        return redirect()->route('tukar2', $hasil->id);
    }

    public function sukses(Request $request, int $id): View
    {
        $tukar = $request->user()->penukaran()->with('lokasi')->findOrFail($id);

        return view('pages.tukar2', ['tukar' => $tukar]);
    }
}
