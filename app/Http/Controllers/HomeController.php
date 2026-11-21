<?php

namespace App\Http\Controllers;

use App\Models\LokasiMitra;
use App\Models\PenukaranItem;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();

        return view('home', [
            'user' => $user,
            'fotoProfil' => $user->fotoUrl(),
            'produkList' => Produk::orderBy('id')->get(),
            'lokasiList' => LokasiMitra::where('aktif', true)->orderBy('id')->limit(4)->get(),
            'keranjang' => KeranjangController::payload($user),
            'setoran' => $user->setoran()->with('lokasi')->latest()->get(),
            'totalPcs' => (int) $user->setoran()->where('status', 'diterima')->sum('jumlah'),
            'totalProdukDitukar' => (int) PenukaranItem::whereIn(
                'penukaran_id', $user->penukaran()->select('id')
            )->sum('qty'),
        ]);
    }
}
