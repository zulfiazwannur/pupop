<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DataUsaha extends Model
{
    protected $table = 'data_usaha';

    protected $fillable = [
        'nama_usaha', 'jenis_usaha', 'telepon', 'deskripsi',
        'jam_buka', 'jam_tutup', 'kapasitas', 'status_buka', 'catatan_status',
    ];

    protected function casts(): array
    {
        return ['status_buka' => 'boolean', 'terisi' => 'float'];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /** Persentase penampungan terisi (0-100). */
    public function persenTerisi(): int
    {
        if ($this->kapasitas <= 0) {
            return 0;
        }
        return (int) min(100, round($this->terisi / $this->kapasitas * 100));
    }
}
