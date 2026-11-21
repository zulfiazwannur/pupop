<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiMitra extends Model
{
    protected $table = 'transaksi_mitra';

    protected $fillable = [
        'user_id', 'setor_popok_id', 'tipe', 'sumber', 'nama',
        'keterangan', 'tanggal', 'jumlah_pcs', 'nominal', 'poin',
    ];

    protected function casts(): array
    {
        return ['tanggal' => 'date', 'jumlah_pcs' => 'float'];
    }

    public function namaTipe(): string
    {
        return ['setor' => 'Setor Popok', 'reward' => 'Reward Mitra', 'tarik' => 'Tarik Saldo'][$this->tipe] ?? $this->tipe;
    }

    public function badge(): array
    {
        // [teks, kelas css yang sudah ada di riwayat]
        return match ($this->tipe) {
            'reward' => ['Bonus', 'bonus'],
            default => ['Berhasil', 'success'],
        };
    }

    /** Data untuk form "Ubah" di halaman riwayat (dikirim ke JavaScript lewat @json). */
    public function dataUbah(): array
    {
        return [
            'id' => $this->id,
            'manual' => $this->sumber === 'manual',
            'nama' => $this->nama,
            'keterangan' => $this->keterangan,
            'tanggal' => $this->tanggal->toDateString(),
            'nominal' => $this->nominal,
            'poin' => $this->poin,
        ];
    }

    /** Teks kolom "Nominal / Jumlah". */
    public function labelJumlah(): string
    {
        $rp = 'Rp. ' . number_format($this->nominal, 0, ',', '.');
        return match ($this->tipe) {
            'setor' => number_format($this->jumlah_pcs, 2, ',', '.') . ' pcs',
            'reward' => $this->poin . ' Point + ' . $rp,
            default => $rp,
        };
    }
}
