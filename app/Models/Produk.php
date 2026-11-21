<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';

    protected $fillable = ['nama', 'kategori', 'deskripsi', 'gambar', 'poin'];

    public function gambarUrl(): string
    {
        return asset('img/' . $this->gambar);
    }
}
