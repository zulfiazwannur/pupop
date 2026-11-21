<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Keranjang extends Model
{
    protected $table = 'keranjang';

    protected $fillable = ['user_id', 'produk_id', 'qty'];

    public function produk(): BelongsTo
    {
        return $this->belongsTo(Produk::class);
    }
}
