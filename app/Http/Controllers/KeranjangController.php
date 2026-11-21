<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * CRUD Keranjang. Dipanggil lewat AJAX (fetch) dari halaman home & tukar,
 * jadi semua method mengembalikan JSON berisi isi keranjang terbaru.
 */
class KeranjangController extends Controller
{
    public const MAKS_QTY = 99;

    /** Isi keranjang milik $user dalam bentuk array siap pakai untuk JSON. */
    public static function payload(User $user): array
    {
        $items = $user->keranjang()->with('produk')->orderBy('id')->get()->map(fn (Keranjang $k) => [
            'id' => $k->id,
            'produk_id' => $k->produk_id,
            'nama' => $k->produk->nama,
            'deskripsi' => $k->produk->deskripsi,
            'kategori' => $k->produk->kategori,
            'gambar' => $k->produk->gambarUrl(),
            'qty' => $k->qty,
            'poin' => $k->produk->poin,
        ])->values();

        return [
            'items' => $items,
            'total_item' => (int) $items->sum('qty'),
            'total_poin' => (int) $items->sum(fn ($i) => $i['qty'] * $i['poin']),
        ];
    }

    /** READ */
    public function index(Request $request): JsonResponse
    {
        return response()->json(self::payload($request->user()));
    }

    /** CREATE: tambah produk ke keranjang (jika sudah ada, qty bertambah). */
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'produk_id' => ['required', 'integer', 'exists:produk,id'],
            'qty' => ['nullable', 'integer', 'min:1', 'max:' . self::MAKS_QTY],
        ], [
            'produk_id.required' => 'Produk belum dipilih.',
            'produk_id.exists' => 'Produk tidak ditemukan.',
            'qty.min' => 'Jumlah minimal 1.',
            'qty.max' => 'Jumlah maksimal ' . self::MAKS_QTY . ' per produk.',
        ]);

        $user = $request->user();
        $produk = Produk::findOrFail($data['produk_id']);

        $baris = $user->keranjang()->firstOrNew(['produk_id' => $produk->id]);
        $baris->qty = min(self::MAKS_QTY, ($baris->exists ? $baris->qty : 0) + ($data['qty'] ?? 1));
        $baris->save();

        return response()->json(self::payload($user) + ['pesan' => $produk->nama . ' ditambahkan ke keranjang.']);
    }

    /** UPDATE: ubah jumlah produk di keranjang. */
    public function update(Request $request, int $id): JsonResponse
    {
        $data = $request->validate([
            'qty' => ['required', 'integer', 'min:1', 'max:' . self::MAKS_QTY],
        ], [
            'qty.required' => 'Jumlah wajib diisi.',
            'qty.integer' => 'Jumlah harus berupa angka.',
            'qty.min' => 'Jumlah minimal 1. Gunakan tombol hapus untuk mengeluarkan produk.',
            'qty.max' => 'Jumlah maksimal ' . self::MAKS_QTY . ' per produk.',
        ]);

        $user = $request->user();
        // Dibatasi ke keranjang milik sendiri: id milik orang lain -> 404.
        $user->keranjang()->findOrFail($id)->update(['qty' => $data['qty']]);

        return response()->json(self::payload($user));
    }

    /** DELETE: keluarkan satu produk dari keranjang. */
    public function destroy(Request $request, int $id): JsonResponse
    {
        $user = $request->user();
        $user->keranjang()->findOrFail($id)->delete();

        return response()->json(self::payload($user));
    }

    /** DELETE: kosongkan seluruh keranjang. */
    public function clear(Request $request): JsonResponse
    {
        $user = $request->user();
        $user->keranjang()->delete();

        return response()->json(self::payload($user));
    }
}
