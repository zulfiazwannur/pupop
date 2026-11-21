<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Penukaran extends Model
{
    protected $table = 'penukaran';

    protected $fillable = ['user_id', 'lokasi_mitra_id', 'jumlah_item', 'total_poin'];

    public function item(): HasMany
    {
        return $this->hasMany(PenukaranItem::class);
    }

    public function lokasi(): BelongsTo
    {
        return $this->belongsTo(LokasiMitra::class, 'lokasi_mitra_id');
    }
}
