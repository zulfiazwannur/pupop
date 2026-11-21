<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LokasiMitra extends Model
{
    protected $table = 'lokasi_mitra';

    protected $fillable = [
        'nama', 'kota', 'alamat', 'jam_buka', 'jam_tutup', 'aktif',
        'alamat_lama', 'alasan_pindah', 'tanggal_pindah',
    ];

    protected function casts(): array
    {
        return ['aktif' => 'boolean', 'tanggal_pindah' => 'date'];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function gambarUrl(): string
    {
        return asset('img/' . ($this->gambar ?: 'log.png'));
    }
}
