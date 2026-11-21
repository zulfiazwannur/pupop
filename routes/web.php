<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\Mitra;
use App\Http\Controllers\PenukaranController;
use App\Http\Controllers\PilihMitraController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SetorController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/home');

// ---------------------------------------------------------------
// Hanya untuk tamu (belum login). Role dipilih di halaman daftar.
// ---------------------------------------------------------------
Route::middleware('guest')->group(function () {
    Route::get('/masuk', [AuthController::class, 'showLogin'])->name('login');
    // Maks. 5 percobaan login per menit (anti brute force)
    Route::post('/masuk', [AuthController::class, 'login'])
        ->middleware('throttle:5,1')
        ->name('login.attempt');

    Route::get('/daftar', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/daftar', [AuthController::class, 'register'])
        ->middleware('throttle:10,1')
        ->name('register.store');
});

// ---------------------------------------------------------------
// Hanya untuk user yang sudah login (kedua role).
// 'nocache' mencegah halaman lama muncul lagi lewat tombol Back setelah logout.
// ---------------------------------------------------------------
Route::middleware(['auth', 'nocache'])->group(function () {
    Route::post('/keluar', [AuthController::class, 'logout'])->name('logout');

    // Profil (CRUD): dipakai pelanggan & mitra
    Route::put('/profil', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profil', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ===================== ROLE PELANGGAN =====================
    Route::middleware('role:pelanggan')->group(function () {
        Route::get('/home', [HomeController::class, 'index'])->name('home');

        // Keranjang (AJAX / JSON)
        Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
        Route::post('/keranjang', [KeranjangController::class, 'store'])->name('keranjang.store');
        Route::delete('/keranjang', [KeranjangController::class, 'clear'])->name('keranjang.clear');
        Route::patch('/keranjang/{id}', [KeranjangController::class, 'update'])->whereNumber('id')->name('keranjang.update');
        Route::delete('/keranjang/{id}', [KeranjangController::class, 'destroy'])->whereNumber('id')->name('keranjang.destroy');

        // Penukaran poin
        Route::get('/tukar', [PenukaranController::class, 'index'])->name('tukar');
        Route::get('/tukar/konfirmasi', [PenukaranController::class, 'konfirmasi'])->name('tukar1');
        Route::post('/tukar', [PenukaranController::class, 'store'])->name('tukar.store');
        Route::get('/tukar/sukses/{id}', [PenukaranController::class, 'sukses'])->whereNumber('id')->name('tukar2');

        // Setor popok
        Route::get('/setor', [SetorController::class, 'create'])->name('setor');
        Route::post('/setor', [SetorController::class, 'store'])->name('setor.store');
        Route::get('/setor/{id}/scan', [SetorController::class, 'scan'])->whereNumber('id')->name('setor1');
        Route::get('/setor/{id}/sukses', [SetorController::class, 'sukses'])->whereNumber('id')->name('setor2');
        Route::put('/setor/{id}', [SetorController::class, 'update'])->whereNumber('id')->name('setor.update');
        Route::delete('/setor/{id}', [SetorController::class, 'destroy'])->whereNumber('id')->name('setor.destroy');

        // Pilih mitra favorit
        Route::get('/pilih-mitra', [PilihMitraController::class, 'index'])->name('pilihmitra');
        Route::post('/pilih-mitra', [PilihMitraController::class, 'store'])->name('pilihmitra.store');
    });

    // ===================== ROLE MITRA =====================
    Route::middleware('role:mitra')->prefix('mitra')->name('mitra.')->group(function () {
        Route::get('/', [Mitra\DashboardController::class, 'index'])->name('home');
        Route::get('/profil', [Mitra\DashboardController::class, 'profile'])->name('profile');

        // Mitra Manajemen
        Route::get('/manajemen', [Mitra\ManajemenController::class, 'index'])->name('manajemen');

        // Lokasi Mitra (CRUD)
        Route::get('/lokasi/tambah', [Mitra\LokasiController::class, 'create'])->name('lokasi.create');
        Route::post('/lokasi', [Mitra\LokasiController::class, 'store'])->name('lokasi.store');
        Route::get('/lokasi/{id}/ubah', [Mitra\LokasiController::class, 'edit'])->whereNumber('id')->name('lokasi.edit');
        Route::put('/lokasi/{id}', [Mitra\LokasiController::class, 'update'])->whereNumber('id')->name('lokasi.update');
        Route::delete('/lokasi/{id}', [Mitra\LokasiController::class, 'destroy'])->whereNumber('id')->name('lokasi.destroy');
        Route::get('/lokasi/sukses/{aksi}', [Mitra\LokasiController::class, 'sukses'])->whereIn('aksi', ['tambah', 'ubah'])->name('lokasi.sukses');

        // Data Usaha (CRUD) + Status Operasional
        Route::get('/usaha', [Mitra\UsahaController::class, 'edit'])->name('usaha.edit');
        Route::post('/usaha', [Mitra\UsahaController::class, 'simpan'])->name('usaha.simpan');
        Route::delete('/usaha', [Mitra\UsahaController::class, 'destroy'])->name('usaha.destroy');
        Route::get('/usaha/sukses/{aksi}', [Mitra\UsahaController::class, 'sukses'])->whereIn('aksi', ['tambah', 'ubah'])->name('usaha.sukses');
        Route::get('/status', [Mitra\UsahaController::class, 'status'])->name('status');
        Route::post('/status', [Mitra\UsahaController::class, 'updateStatus'])->name('status.update');

        // Riwayat Transaksi (CRUD)
        Route::get('/riwayat', [Mitra\TransaksiController::class, 'index'])->name('riwayat');
        Route::post('/riwayat', [Mitra\TransaksiController::class, 'store'])->name('riwayat.store');
        Route::put('/riwayat/{id}', [Mitra\TransaksiController::class, 'update'])->whereNumber('id')->name('riwayat.update');
        Route::delete('/riwayat/{id}', [Mitra\TransaksiController::class, 'destroy'])->whereNumber('id')->name('riwayat.destroy');

        // Terima setor
        Route::get('/terima-setor', [Mitra\TerimaSetorController::class, 'index'])->name('terima');
        Route::post('/terima-setor/pilih', [Mitra\TerimaSetorController::class, 'pilih'])->name('terima.pilih');
        Route::get('/terima-setor/sukses', [Mitra\TerimaSetorController::class, 'sukses'])->name('terima.sukses');
        Route::get('/terima-setor/{id}', [Mitra\TerimaSetorController::class, 'detail'])->whereNumber('id')->name('terima.detail');
        Route::post('/terima-setor/{id}', [Mitra\TerimaSetorController::class, 'terima'])->whereNumber('id')->name('terima.proses');

        // Tarik saldo
        Route::get('/tarik', [Mitra\TarikController::class, 'index'])->name('tarik');
        Route::post('/tarik', [Mitra\TarikController::class, 'store'])->name('tarik.store');
        Route::get('/tarik/sukses', [Mitra\TarikController::class, 'sukses'])->name('tarik.sukses');

        // Pickup & laporan
        Route::get('/pickup', [Mitra\PickupController::class, 'index'])->name('pickup');
        Route::post('/pickup', [Mitra\PickupController::class, 'store'])->name('pickup.store');
        Route::get('/pickup/sukses', [Mitra\PickupController::class, 'sukses'])->name('pickup.sukses');
        Route::patch('/pickup/{id}/selesai', [Mitra\PickupController::class, 'selesai'])->whereNumber('id')->name('pickup.selesai');
        Route::get('/laporan', [Mitra\LaporanController::class, 'index'])->name('laporan');
    });
});
