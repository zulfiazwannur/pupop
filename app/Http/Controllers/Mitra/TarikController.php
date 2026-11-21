<?php

namespace App\Http\Controllers\Mitra;

use App\Http\Controllers\Controller;
use App\Models\TransaksiMitra;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

/** Penarikan saldo mitra. Setiap penarikan otomatis masuk Riwayat Transaksi. */
class TarikController extends Controller
{
    private const BANK = ['bca' => 'BCA', 'mandiri' => 'Bank Mandiri', 'bni' => 'BNI', 'bri' => 'BRI'];
    private const EWALLET = ['gopay' => 'GoPay', 'ovo' => 'OVO', 'dana' => 'DANA', 'linkaja' => 'LinkAja'];

    public function index(Request $request): View
    {
        return view('mitra.tarik', ['user' => $request->user()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'jumlah' => ['required', 'integer', 'min:10000'],
            'bank' => ['nullable', Rule::in(array_keys(self::BANK)), 'required_without:ewallet', 'prohibits:ewallet'],
            'ewallet' => ['nullable', Rule::in(array_keys(self::EWALLET)), 'required_without:bank'],
            'tujuan' => ['required', 'regex:/^[0-9]{8,20}$/'],
        ], [
            'jumlah.required' => 'Jumlah penarikan wajib diisi.',
            'jumlah.integer' => 'Jumlah penarikan harus berupa angka tanpa titik atau koma.',
            'jumlah.min' => 'Penarikan minimal Rp 10.000.',
            'bank.required_without' => 'Pilih rekening bank atau e-wallet.',
            'bank.prohibits' => 'Pilih salah satu saja: rekening bank atau e-wallet.',
            'bank.in' => 'Bank yang dipilih tidak valid.',
            'ewallet.required_without' => 'Pilih rekening bank atau e-wallet.',
            'ewallet.in' => 'E-wallet yang dipilih tidak valid.',
            'tujuan.required' => 'Nomor rekening / HP e-wallet wajib diisi.',
            'tujuan.regex' => 'Nomor rekening / HP hanya boleh angka (8-20 digit).',
        ]);

        $metode = ! empty($data['bank']) ? self::BANK[$data['bank']] : self::EWALLET[$data['ewallet']];
        $akhir = substr($data['tujuan'], -4); // nomor lengkap tidak disimpan
        $mitra = $request->user();

        $hasil = DB::transaction(function () use ($mitra, $data, $metode, $akhir) {
            $u = User::lockForUpdate()->find($mitra->id); // kunci baris agar saldo tidak minus
            if ($u->saldo < $data['jumlah']) {
                return 'Saldo tidak cukup. Saldo Anda Rp ' . number_format($u->saldo, 0, ',', '.') . '.';
            }
            $u->decrement('saldo', $data['jumlah']);

            $trx = new TransaksiMitra([
                'nama' => 'Tarik ke ' . $metode,
                'keterangan' => 'Penarikan saldo ke ' . $metode . ' (****' . $akhir . ')',
                'tanggal' => now()->toDateString(),
                'nominal' => $data['jumlah'],
            ]);
            $trx->user_id = $u->id;
            $trx->tipe = 'tarik';
            $trx->sumber = 'otomatis';
            $trx->save();

            return true;
        });

        if ($hasil !== true) {
            return back()->withInput()->withErrors(['jumlah' => $hasil]);
        }

        return redirect()->route('mitra.tarik.sukses');
    }

    public function sukses(): View
    {
        return view('mitra.tarik1');
    }
}
