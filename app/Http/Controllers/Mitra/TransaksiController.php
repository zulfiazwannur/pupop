<?php

namespace App\Http\Controllers\Mitra;

use App\Http\Controllers\Controller;
use App\Models\TransaksiMitra;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * CRUD Riwayat Transaksi Mitra.
 *  Create : catatan manual (reward/bonus) lewat tombol "Tambah Catatan";
 *           transaksi setor & tarik saldo dibuat otomatis oleh controller lain.
 *  Read   : tabel + pencarian + filter tipe + pagination
 *  Update : catatan manual bisa diubah penuh; transaksi otomatis hanya keterangannya
 *  Delete : hapus catatan dari riwayat (tidak mengubah saldo/poin)
 */
class TransaksiController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();
        $q = trim((string) $request->query('q', ''));
        $tipe = $request->query('tipe');

        $query = $user->transaksiMitra()
            ->when($q !== '', function ($s) use ($q) {
                $like = '%' . addcslashes($q, '%_\\') . '%';
                $s->where(fn ($w) => $w->where('nama', 'like', $like)->orWhere('keterangan', 'like', $like));
            })
            ->when(in_array($tipe, ['setor', 'reward', 'tarik'], true), fn ($s) => $s->where('tipe', $tipe));

        $total = (clone $query)->selectRaw(
            "COALESCE(SUM(CASE WHEN tipe='setor' THEN jumlah_pcs ELSE 0 END),0) AS pcs,
             COALESCE(SUM(CASE WHEN tipe IN ('setor','reward') THEN nominal ELSE 0 END),0) AS reward,
             COALESCE(SUM(poin),0) AS poin"
        )->first();

        return view('mitra.riwayat', [
            'transaksi' => $query->orderByDesc('tanggal')->orderByDesc('id')->paginate(10)->withQueryString(),
            'total' => $total,
            'q' => $q,
            'tipe' => $tipe,
        ]);
    }

    private function aturan(bool $penuh): array
    {
        if (! $penuh) {
            return ['keterangan' => ['required', 'string', 'min:3', 'max:255']];
        }

        return [
            'nama' => ['required', 'string', 'min:3', 'max:100'],
            'keterangan' => ['required', 'string', 'min:3', 'max:255'],
            'tanggal' => ['required', 'date', 'before_or_equal:today'],
            'nominal' => ['required', 'integer', 'min:0', 'max:100000000'],
            'poin' => ['required', 'integer', 'min:0', 'max:1000000'],
        ];
    }

    private function pesan(): array
    {
        return [
            'nama.required' => 'Judul/nama transaksi wajib diisi.',
            'nama.min' => 'Judul minimal 3 karakter.',
            'keterangan.required' => 'Keterangan wajib diisi.',
            'keterangan.min' => 'Keterangan minimal 3 karakter.',
            'keterangan.max' => 'Keterangan maksimal 255 karakter.',
            'tanggal.required' => 'Tanggal wajib diisi.',
            'tanggal.date' => 'Format tanggal tidak valid.',
            'tanggal.before_or_equal' => 'Tanggal tidak boleh di masa depan.',
            'nominal.required' => 'Nominal wajib diisi (isi 0 jika tidak ada).',
            'nominal.integer' => 'Nominal harus berupa angka bulat tanpa titik/koma.',
            'nominal.min' => 'Nominal tidak boleh negatif.',
            'nominal.max' => 'Nominal terlalu besar.',
            'poin.required' => 'Poin wajib diisi (isi 0 jika tidak ada).',
            'poin.integer' => 'Poin harus berupa angka bulat.',
            'poin.min' => 'Poin tidak boleh negatif.',
        ];
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate($this->aturan(true), $this->pesan());

        $trx = new TransaksiMitra($data);
        $trx->user_id = $request->user()->id;
        $trx->tipe = 'reward';
        $trx->sumber = 'manual';
        $trx->save();

        return redirect()->route('mitra.riwayat')->with('status', 'Catatan transaksi berhasil ditambahkan.');
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $trx = $request->user()->transaksiMitra()->findOrFail($id);
        $data = $request->validate($this->aturan($trx->sumber === 'manual'), $this->pesan());
        $trx->update($data);

        return redirect()->route('mitra.riwayat')->with('status', 'Transaksi berhasil diubah.');
    }

    public function destroy(Request $request, int $id): RedirectResponse
    {
        $request->user()->transaksiMitra()->findOrFail($id)->delete();

        return redirect()->route('mitra.riwayat')->with('status', 'Transaksi berhasil dihapus dari riwayat.');
    }
}
