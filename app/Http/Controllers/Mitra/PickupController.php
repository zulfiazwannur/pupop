<?php

namespace App\Http\Controllers\Mitra;

use App\Http\Controllers\Controller;
use App\Models\PickupMitra;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/** Permintaan pickup popok dari penampungan mitra ke pusat. */
class PickupController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();

        return view('mitra.pickup', [
            'lokasiList' => $user->lokasiMitra()->orderBy('id')->get(),
            'riwayat' => PickupMitra::with('lokasi')->where('user_id', $user->id)->orderByDesc('tanggal')->limit(10)->get(),
            'berikutnya' => PickupMitra::with('lokasi')->where('user_id', $user->id)->where('status', 'menunggu')->orderBy('tanggal')->first(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'lokasi_mitra_id' => ['required', 'integer'],
            'tanggal' => ['required', 'date', 'after_or_equal:today'],
            'catatan' => ['nullable', 'string', 'max:255'],
        ], [
            'lokasi_mitra_id.required' => 'Pilih lokasi mitra.',
            'tanggal.required' => 'Tanggal pickup wajib diisi.',
            'tanggal.date' => 'Format tanggal tidak valid.',
            'tanggal.after_or_equal' => 'Tanggal pickup tidak boleh di masa lalu.',
            'catatan.max' => 'Catatan maksimal 255 karakter.',
        ]);

        $lokasi = $request->user()->lokasiMitra()->find($data['lokasi_mitra_id']);
        if (! $lokasi) {
            return back()->withInput()->withErrors(['lokasi_mitra_id' => 'Lokasi tidak ditemukan.']);
        }

        $pickup = new PickupMitra(['tanggal' => $data['tanggal'], 'catatan' => $data['catatan'] ?? null]);
        $pickup->user_id = $request->user()->id;
        $pickup->lokasi_mitra_id = $lokasi->id;
        $pickup->save();

        return redirect()->route('mitra.pickup.sukses');
    }

    /** Tandai pickup selesai: penampungan dikosongkan. */
    public function selesai(Request $request, int $id): RedirectResponse
    {
        $user = $request->user();
        $pickup = PickupMitra::where('user_id', $user->id)->where('status', 'menunggu')->findOrFail($id);
        $pickup->update(['status' => 'selesai']);
        $user->dataUsaha?->update(['terisi' => 0]);

        return redirect()->route('mitra.pickup')->with('status', 'Pickup ditandai selesai, penampungan dikosongkan.');
    }

    public function sukses(): View
    {
        return view('mitra.request');
    }
}
