<?php

namespace App\Http\Controllers\Mitra;

use App\Http\Controllers\Controller;
use App\Models\PickupMitra;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();

        return view('mitra.home', [
            'user' => $user,
            'usaha' => $user->dataUsaha,
            'pickup' => PickupMitra::where('user_id', $user->id)->where('status', 'menunggu')
                ->orderBy('tanggal')->first(),
            'riwayat' => $user->transaksiMitra()->orderByDesc('tanggal')->orderByDesc('id')->limit(3)->get(),
        ]);
    }

    public function profile(Request $request): View
    {
        $user = $request->user();

        return view('mitra.profile', [
            'user' => $user,
            'fotoProfil' => $user->fotoUrl('img/mitra/21.png'),
            'lokasi' => $user->lokasiMitra()->orderBy('id')->first(),
            'layananSelesai' => $user->transaksiMitra()->where('tipe', 'setor')->count(),
        ]);
    }
}
