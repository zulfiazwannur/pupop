<?php

namespace App\Http\Controllers\Mitra;

use App\Http\Controllers\Controller;
use App\Models\LokasiMitra;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * CRUD Lokasi Mitra (khusus role mitra).
 * Semua query lewat $request->user()->lokasiMitra() sehingga mitra hanya bisa
 * melihat/mengubah/menghapus lokasi miliknya sendiri.
 */
class LokasiController extends Controller
{
    private function aturan(bool $edit): array
    {
        $aturan = [
            'nama' => ['required', 'string', 'min:3', 'max:100'],
            'kota' => ['required', 'string', 'max:100'],
            'alamat' => ['required', 'string', 'min:5', 'max:255'],
            'jam_buka' => ['required', 'date_format:H:i'],
            'jam_tutup' => ['required', 'date_format:H:i', 'after:jam_buka'],
        ];
        if ($edit) {
            $aturan['alasan_pindah'] = ['nullable', 'string', 'max:255'];
            $aturan['tanggal_pindah'] = ['nullable', 'date', 'before_or_equal:today'];
        }

        return $aturan;
    }

    private function pesan(): array
    {
        return [
            'nama.required' => 'Nama lokasi wajib diisi.',
            'nama.min' => 'Nama lokasi minimal 3 karakter.',
            'kota.required' => 'Kota wajib diisi.',
            'alamat.required' => 'Alamat lokasi wajib diisi.',
            'alamat.min' => 'Alamat terlalu pendek, tulis alamat selengkapnya.',
            'jam_buka.required' => 'Jam buka wajib diisi.',
            'jam_buka.date_format' => 'Format jam buka harus JJ:MM, misalnya 08:00.',
            'jam_tutup.required' => 'Jam tutup wajib diisi.',
            'jam_tutup.date_format' => 'Format jam tutup harus JJ:MM, misalnya 17:00.',
            'jam_tutup.after' => 'Jam tutup harus setelah jam buka.',
            'tanggal_pindah.date' => 'Format tanggal tidak valid.',
            'tanggal_pindah.before_or_equal' => 'Tanggal pindah tidak boleh di masa depan.',
        ];
    }

    public function create(): View
    {
        return view('mitra.lokasi.form', ['lokasi' => new LokasiMitra(['jam_buka' => '08:00', 'jam_tutup' => '17:00'])]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate($this->aturan(false), $this->pesan());

        $lokasi = new LokasiMitra($data);
        $lokasi->user_id = $request->user()->id;
        $lokasi->save();

        return redirect()->route('mitra.lokasi.sukses', 'tambah');
    }

    public function edit(Request $request, int $id): View
    {
        return view('mitra.lokasi.form', ['lokasi' => $request->user()->lokasiMitra()->findOrFail($id)]);
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $data = $request->validate($this->aturan(true), $this->pesan());
        $lokasi = $request->user()->lokasiMitra()->findOrFail($id);

        // Jika alamat berubah, alamat sebelumnya disimpan sebagai "lokasi lama".
        if ($lokasi->alamat !== $data['alamat']) {
            $data['alamat_lama'] = $lokasi->alamat;
        }
        $lokasi->update($data);

        return redirect()->route('mitra.lokasi.sukses', 'ubah');
    }

    public function destroy(Request $request, int $id): RedirectResponse
    {
        $lokasi = $request->user()->lokasiMitra()->findOrFail($id);
        $lokasi->delete();

        return redirect()->route('mitra.manajemen')->with('status', 'Lokasi berhasil dihapus.');
    }

    public function sukses(string $aksi): View
    {
        return view('mitra.lokasi.sukses', ['aksi' => $aksi === 'tambah' ? 'ditambahkan' : 'diperbarui']);
    }
}
