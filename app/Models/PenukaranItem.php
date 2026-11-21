<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenukaranItem extends Model
{
    protected $table = 'penukaran_item';

    public $timestamps = false;

    protected $fillable = ['penukaran_id', 'produk_id', 'nama', 'kategori', 'qty', 'poin_satuan'];
}
