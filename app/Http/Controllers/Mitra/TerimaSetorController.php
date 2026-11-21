<?php

namespace App\Http\Controllers\Mitra;

use App\Http\Controllers\Controller;
use App\Models\SetorPopok;
use App\Models\TransaksiMitra;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

/** Mitra menerima setoran popok dari pelanggan. */
class TerimaSetorController extends Controller
{
    public const POIN_MITRA_PER_PCS = 1;

    /** Setoran berstatus "menunggu" pada lokasi milik mitra yang login. */
    private function menunggu(Request $request)
    {
        $idLokasi = $request->user()->lokasiMitra()->pluck('id');

        return SetorPopok::with('user')
            ->whereIn('lokasi_mitra_id', $idLokasi)
            ->where('status', 'menunggu');
    }

    public function index(Request $request): View
    {
        return view('mitra.terimaSetor', [
            'lokasi' => $request->user()->lokasiMitra()->orderBy('id')->first(),
            'antrian' => $this->menunggu($request)->orderBy('id')->get(),
        ]);
    }

    public function pilih(Request $request): RedirectResponse
    {
        $data = $request->validate(['setor_id' => ['required', 'integer']], [
            'setor_id.required' => 'Pilih setoran yang akan diterima.',
        ]);

        $setor = $this->menunggu($request)->find($data['setor_id']);
        if (! $setor) {
            return back()->withErrors(['setor_id' => 'Setoran tidak ditemukan atau sudah diproses.']);
        }

        return redirect()->route('mitra.terima.detail', $setor->id);
    }

    public function detail(Request $request, int $id): View
    {
        $setor = $this->menunggu($request)->findOrFail($id);

        return view('mitra.terimaSetor1', [
            'setor' => $setor,
            'poin' => $setor->jumlah * SetorPopok::POIN_PER_PCS,
        ]);
    }

    /**
     * Terima setoran. Satu transaksi database untuk 5 perubahan sekaligus:
     * status setoran, poin pelanggan, saldo+poin mitra, kapasitas usaha, dan riwayat transaksi.
     */
    public function terima(Request $request, int $id): RedirectResponse
    {
        $mitra = $request->user();

        $ok = DB::transaction(function () use ($request, $mitra, $id) {
            $setor = $this->menunggu($request)->lockForUpdate()->find($id);
            if (! $setor) {
                return false;
            }

            $poin = $setor->jumlah * SetorPopok::POIN_PER_PCS;
            $reward = $setor->jumlah * SetorPopok::REWARD_PER_PCS;

            $setor->status = 'diterima';
            $setor->poin_didapat = $poin;
            $setor->diterima_pada = now();
            $setor->save();

            $setor->user->increment('poin', $poin);                      // poin pelanggan
            $mitra->increment('saldo', $reward);                         // saldo mitra
            $mitra->increment('poin', $setor->jumlah * self::POIN_MITRA_PER_PCS);

            $mitra->dataUsaha?->increment('terisi', $setor->jumlah);     // penampungan bertambah

            $trx = new TransaksiMitra([
                'nama' => 'User ' . $setor->user->name,
                'keterangan' => 'sukses menyetor popok (kode ' . $setor->kode . ')',
                'tanggal' => now()->toDateString(),
                'jumlah_pcs' => $setor->jumlah,
                'nominal' => $reward,
                'poin' => $setor->jumlah * self::POIN_MITRA_PER_PCS,
            ]);
            $trx->user_id = $mitra->id;
            $trx->setor_popok_id = $setor->id;
            $trx->tipe = 'setor';
            $trx->sumber = 'otomatis';
            $trx->save();

            return true;
        });

        if (! $ok) {
            return redirect()->route('mitra.terima')->with('status', 'Setoran tidak ditemukan atau sudah diproses.');
        }

        return redirect()->route('mitra.terima.sukses');
    }

    public function sukses(): View
    {
        return view('mitra.terimaSetor2');
    }
}
