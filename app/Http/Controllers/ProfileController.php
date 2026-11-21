<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

/**
 * CRUD profil (dipakai pelanggan maupun mitra):
 *  - Read   : ditampilkan di halaman profil (home / mitra.profile)
 *  - Update : nama, lokasi, foto
 *  - Delete : hapus foto, hapus akun
 */
class ProfileController extends Controller
{
    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:100'],
            'lokasi' => ['nullable', 'string', 'max:255'],
            // Laravel memeriksa isi file (bukan sekadar ekstensi dari nama file).
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'hapus_foto' => ['nullable', 'boolean'],
        ], [
            'name.required' => 'Nama wajib diisi.',
            'name.min' => 'Nama minimal 3 karakter.',
            'name.max' => 'Nama maksimal 100 karakter.',
            'lokasi.max' => 'Lokasi maksimal 255 karakter.',
            'foto.image' => 'Format foto harus JPG, JPEG, atau PNG.',
            'foto.mimes' => 'Format foto harus JPG, JPEG, atau PNG.',
            'foto.max' => 'Ukuran foto maksimal 2 MB.',
            'foto.uploaded' => 'Foto gagal diupload.',
        ]);

        $user = $request->user();
        $user->name = $data['name'];
        $user->lokasi = $data['lokasi'] ?? null;

        if ($request->hasFile('foto')) {
            // store() membuat nama acak; disimpan di storage/app/public/profile.
            $path = $request->file('foto')->store('profile', 'public');
            if ($user->foto_profil) {
                Storage::disk('public')->delete($user->foto_profil);
            }
            $user->foto_profil = $path;
        } elseif ($request->boolean('hapus_foto') && $user->foto_profil) {
            Storage::disk('public')->delete($user->foto_profil);
            $user->foto_profil = null;
        }

        $user->save();

        return back()->with('status', 'Profil berhasil diperbarui.');
    }

    /** Hapus akun beserta seluruh datanya (relasi memakai ON DELETE CASCADE). */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate(['password_hapus' => ['required', 'string']], [
            'password_hapus.required' => 'Masukkan password untuk menghapus akun.',
        ]);

        $user = $request->user();

        if (! Hash::check($request->input('password_hapus'), $user->password)) {
            return back()->withErrors(['password_hapus' => 'Password salah. Akun tidak dihapus.']);
        }

        if ($user->foto_profil) {
            Storage::disk('public')->delete($user->foto_profil);
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $user->delete();

        return redirect()->route('register')->with('status', 'Akun berhasil dihapus.');
    }
}
