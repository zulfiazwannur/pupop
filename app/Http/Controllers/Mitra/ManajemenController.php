<?php

namespace App\Http\Controllers\Mitra;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ManajemenController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();
        $usaha = $user->dataUsaha;
        $totalPcs = (float) $user->transaksiMitra()->where('tipe', 'setor')->sum('jumlah_pcs');

        // Level mitra dihitung otomatis dari total popok yang pernah diterima.
        $level = match (true) {
            $totalPcs >= 1000 => 'Platinum',
            $totalPcs >= 500 => 'Gold',
            $totalPcs >= 100 => 'Silver',
            default => 'Bronze',
        };

        return view('mitra.manajemenmitra', [
            'user' => $user,
            'usaha' => $usaha,
            'daftarLokasi' => $user->lokasiMitra()->orderBy('id')->get(),
            'level' => $level,
        ]);
    }
}
