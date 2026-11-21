<?php

namespace App\Http\Controllers\Mitra;

use App\Http\Controllers\Controller;
use App\Models\DataUsaha;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * CRUD Data Usaha mitra (1 mitra = 1 data usaha) + Status Operasional.
 */
class UsahaController extends Controller
{
    /** Form tambah (jika belum ada) atau ubah (jika sudah ada). */
    public function edit(Request $request): View
    {
        $usaha = $request->user()->dataUsaha ?? new DataUsaha(['jam_buka' => '08:00', 'jam_tutup' => '17:00', 'kapasitas' => 100]);

        return view('mitra.usaha.form', ['usaha' => $usaha]);
    }

    /** CREATE atau UPDATE (upsert) */
    public function simpan(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'nama_usaha' => ['required', 'string', 'min:3', 'max:100'],
            'jenis_usaha' => ['nullable', 'string', 'max:100'],
            'telepon' => ['nullable', 'regex:/^[0-9+\-\s]{8,20}$/'],
            'deskripsi' => ['nullable', 'string', 'max:1000'],
            'jam_buka' => ['required', 'date_format:H:i'],
            'jam_tutup' => ['required', 'date_format:H:i', 'after:jam_buka'],
            'kapasitas' => ['required', 'integer', 'min:10', 'max:10000'],
        ], [
            'nama_usaha.required' => 'Nama usaha wajib diisi.',
            'nama_usaha.min' => 'Nama usaha minimal 3 karakter.',
            'telepon.regex' => 'Nomor telepon hanya boleh angka (8-20 digit), boleh diawali +.',
            'jam_buka.required' => 'Jam buka wajib diisi.',
            'jam_buka.date_format' => 'Format jam buka harus JJ:MM.',
            'jam_tutup.required' => 'Jam tutup wajib diisi.',
            'jam_tutup.date_format' => 'Format jam tutup harus JJ:MM.',
            'jam_tutup.after' => 'Jam tutup harus setelah jam buka.',
            'kapasitas.required' => 'Kapasitas wajib diisi.',
            'kapasitas.integer' => 'Kapasitas harus berupa angka bulat.',
            'kapasitas.min' => 'Kapasitas minimal 10 pcs.',
            'kapasitas.max' => 'Kapasitas maksimal 10.000 pcs.',
        ]);

        $user = $request->user();
        $usaha = $user->dataUsaha ?? new DataUsaha();
        $baru = ! $usaha->exists;
        $usaha->fill($data);
        $usaha->user_id = $user->id;
        $usaha->save();

        return redirect()->route('mitra.usaha.sukses', $baru ? 'tambah' : 'ubah');
    }

    /** DELETE */
    public function destroy(Request $request): RedirectResponse
    {
        $request->user()->dataUsaha?->delete();

        return redirect()->route('mitra.manajemen')->with('status', 'Data usaha berhasil dihapus.');
    }

    public function sukses(string $aksi): View
    {
        return view('mitra.lokasi.sukses', ['aksi' => $aksi === 'tambah' ? 'ditambahkan' : 'diperbarui', 'jenis' => 'Data usaha']);
    }

    public function status(Request $request): View|RedirectResponse
    {
        $usaha = $request->user()->dataUsaha;
        if (! $usaha) {
            return redirect()->route('mitra.usaha.edit')->with('status', 'Isi data usaha terlebih dahulu.');
        }

        return view('mitra.status', ['usaha' => $usaha]);
    }

    public function updateStatus(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'status_buka' => ['nullable', 'boolean'],
            'catatan_status' => ['nullable', 'string', 'max:255'],
        ], [
            'catatan_status.max' => 'Catatan maksimal 255 karakter.',
        ]);

        $usaha = $request->user()->dataUsaha;
        if (! $usaha) {
            return redirect()->route('mitra.usaha.edit')->with('status', 'Isi data usaha terlebih dahulu.');
        }

        $usaha->status_buka = $request->boolean('status_buka');
        $usaha->catatan_status = $data['catatan_status'] ?? null;
        $usaha->save();

        return redirect()->route('mitra.manajemen')->with('status', 'Status operasional berhasil disimpan.');
    }
}
