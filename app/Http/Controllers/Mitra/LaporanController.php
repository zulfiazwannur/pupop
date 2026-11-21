<?php

namespace App\Http\Controllers\Mitra;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LaporanController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();

        // Pilihan bulan: 12 bulan terakhir. Input bulan divalidasi manual (format YYYY-MM).
        $pilihan = [];
        for ($i = 0; $i < 12; $i++) {
            $b = now()->startOfMonth()->subMonths($i);
            $pilihan[$b->format('Y-m')] = $b->locale('id')->translatedFormat('F Y');
        }
        $bulan = (string) $request->query('bulan', now()->format('Y-m'));
        if (! isset($pilihan[$bulan])) {
            $bulan = now()->format('Y-m');
        }

        $awal = Carbon::createFromFormat('Y-m-d', $bulan . '-01')->startOfDay();
        $baris = $user->transaksiMitra()
            ->whereIn('tipe', ['setor', 'reward'])
            ->whereBetween('tanggal', [$awal->toDateString(), $awal->copy()->endOfMonth()->toDateString()])
            ->orderBy('tanggal')->orderBy('id')->get();

        return view('mitra.laporan', [
            'pilihan' => $pilihan,
            'bulan' => $bulan,
            'baris' => $baris,
            'totalPopok' => $baris->where('tipe', 'setor')->sum('jumlah_pcs'),
            'totalReward' => $baris->sum('nominal'),
        ]);
    }
}
