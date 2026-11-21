<?php

namespace App\Http\Controllers;

use App\Models\LokasiMitra;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/** Pelanggan memilih mitra favorit (dipakai saat setor popok & tukar poin). */
class PilihMitraController extends Controller
{
    public function index(Request $request): View
    {
        $kota = trim((string) $request->query('kota', ''));

        // Ingat halaman asal (setor / tukar) supaya setelah Simpan pengguna kembali ke sana.
        $asal = url()->previous();
        if (str_starts_with($asal, url('/')) && ! str_contains($asal, '/pilih-mitra')) {
            session(['pilihmitra_kembali' => $asal]);
        }

        $daftar = LokasiMitra::where('aktif', true)
            ->when($kota !== '', fn ($q) => $q->where('kota', 'like', '%' . addcslashes($kota, '%_\\') . '%'))
            ->orderBy('nama')
            ->get();

        return view('pages.pilihmitra', [
            'daftar' => $daftar,
            'kota' => $kota,
            'terpilih' => $request->user()->mitra_pilihan_id,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'lokasi_mitra_id' => ['required', 'integer'],
        ], [
            'lokasi_mitra_id.required' => 'Pilih salah satu mitra terlebih dahulu.',
        ]);

        $lokasi = LokasiMitra::where('aktif', true)->find($data['lokasi_mitra_id']);
        if (! $lokasi) {
            return back()->withErrors(['lokasi_mitra_id' => 'Mitra tidak ditemukan atau sedang tidak aktif.']);
        }

        $user = $request->user();
        $user->mitra_pilihan_id = $lokasi->id;
        $user->save();

        $kembali = session()->pull('pilihmitra_kembali');

        return ($kembali ? redirect()->to($kembali) : back())
            ->with('status', 'Mitra berhasil dipilih dan disimpan.');
    }
}
