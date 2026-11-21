<?php

namespace App\Http\Controllers;

use App\Models\SetorPopok;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

/**
 * CRUD Data Setor Popok (sisi pelanggan).
 *  Create : store()    -> halaman setor
 *  Read   : riwayat di home, scan(), sukses()
 *  Update : update()   -> ubah jumlah selama status masih "menunggu"
 *  Delete : destroy()  -> batalkan setoran selama status masih "menunggu"
 * Setoran yang sudah diterima mitra dikunci karena poin sudah dibagikan.
 */
class SetorController extends Controller
{
    private function aturan(): array
    {
        return ['jumlah' => ['required', 'integer', 'min:1', 'max:' . SetorPopok::MAKS_PCS]];
    }

    private function pesan(): array
    {
        return [
            'jumlah.required' => 'Jumlah popok wajib diisi.',
            'jumlah.integer' => 'Jumlah popok harus berupa angka bulat, misalnya 5.',
            'jumlah.min' => 'Jumlah popok minimal 1 pcs.',
            'jumlah.max' => 'Jumlah popok maksimal ' . SetorPopok::MAKS_PCS . ' pcs sekali setor.',
        ];
    }

    public function create(Request $request): View
    {
        return view('pages.setor', ['lokasi' => $request->user()->mitraPilihan]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate($this->aturan(), $this->pesan());
        $user = $request->user();

        if (! $user->mitra_pilihan_id || ! $user->mitraPilihan?->aktif) {
            return back()->withInput()->with('status', 'Pilih lokasi mitra terlebih dahulu.');
        }

        $setor = new SetorPopok(['jumlah' => $data['jumlah']]);
        $setor->user_id = $user->id;
        $setor->lokasi_mitra_id = $user->mitra_pilihan_id;
        $setor->kode = strtoupper(Str::random(8));
        $setor->save();

        return redirect()->route('setor1', $setor->id);
    }

    public function scan(Request $request, int $id): View
    {
        $setor = $request->user()->setoran()->with('lokasi')->findOrFail($id);

        return view('pages.setor1', ['setor' => $setor]);
    }

    public function sukses(Request $request, int $id): View
    {
        $setor = $request->user()->setoran()->with('lokasi')->findOrFail($id);

        return view('pages.setor2', ['setor' => $setor]);
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $data = $request->validate($this->aturan(), $this->pesan());
        $setor = $request->user()->setoran()->findOrFail($id);

        if (! $setor->menunggu()) {
            return $this->kembaliKeRiwayat()->with('status', 'Setoran yang sudah diterima mitra tidak bisa diubah.');
        }

        $setor->update(['jumlah' => $data['jumlah']]);

        return $this->kembaliKeRiwayat()->with('status', 'Jumlah setoran berhasil diubah.');
    }

    public function destroy(Request $request, int $id): RedirectResponse
    {
        $setor = $request->user()->setoran()->findOrFail($id);

        if (! $setor->menunggu()) {
            return $this->kembaliKeRiwayat()->with('status', 'Setoran yang sudah diterima mitra tidak bisa dihapus.');
        }

        $setor->delete();

        return $this->kembaliKeRiwayat()->with('status', 'Setoran berhasil dibatalkan.');
    }

    private function kembaliKeRiwayat(): RedirectResponse
    {
        return redirect()->route('home', ['tab' => 'riwayat']);
    }
}
