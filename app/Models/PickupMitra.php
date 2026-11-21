<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PickupMitra extends Model
{
    protected $table = 'pickup_mitra';

    protected $fillable = ['user_id', 'lokasi_mitra_id', 'tanggal', 'catatan', 'status'];

    protected function casts(): array
    {
        return ['tanggal' => 'date'];
    }

    public function lokasi(): BelongsTo
    {
        return $this->belongsTo(LokasiMitra::class, 'lokasi_mitra_id');
    }
}
