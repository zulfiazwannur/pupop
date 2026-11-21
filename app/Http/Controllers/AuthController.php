<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLogin(): View
    {
        return view('auth.signin');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ], [
            'email.required' => 'Harap isi Email dan Password terlebih dahulu!',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Harap isi Email dan Password terlebih dahulu!',
        ]);

        // Auth::attempt memakai query ber-parameter + Hash::check (bcrypt),
        // jadi input seperti ' OR '1'='1 tidak pernah ditafsirkan sebagai SQL.
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // cegah session fixation

            // Tujuan setelah login ditentukan oleh role yang dipilih saat daftar.
            $beranda = Auth::user()->isMitra() ? route('mitra.home') : route('home');

            return redirect()->intended($beranda);
        }

        return back()
            ->withErrors(['email' => 'Email atau Password salah atau tidak ditemukan!'])
            ->onlyInput('email');
    }

    public function showRegister(): View
    {
        return view('auth.signup');
    }

    public function register(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'max:72'],
            'role' => ['required', Rule::in(['pelanggan', 'mitra'])],
            'terms' => ['accepted'],
        ], [
            'name.required' => 'Harap lengkapi semua field pendaftaran!',
            'name.max' => 'Nama maksimal 100 karakter.',
            'email.required' => 'Harap lengkapi semua field pendaftaran!',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar. Silakan gunakan email lain!',
            'password.required' => 'Harap lengkapi semua field pendaftaran!',
            'password.min' => 'Password minimal 8 karakter.',
            'password.max' => 'Password maksimal 72 karakter.',
            'role.required' => 'Silahkan Pilih Role!!!',
            'role.in' => 'Role tidak valid. Pilih Pelanggan atau Mitra.',
            'terms.accepted' => 'Anda harus menyetujui Terms & Conditions!',
        ]);

        $user = new User([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'], // di-hash otomatis oleh cast "hashed"
        ]);
        $user->role = $data['role']; // role tidak ada di $fillable, diisi manual dari data tervalidasi
        $user->save();

        return redirect()
            ->route('login')
            ->with('status', 'Pendaftaran berhasil. Silakan masuk.');
    }

    public function logout(Request $request): RedirectResponse
    {
        // Whitelist: hanya 'signup' yang dikenali, selain itu ke halaman masuk.
        $tujuan = $request->input('tujuan') === 'signup' ? 'register' : 'login';

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route($tujuan);
    }
}
