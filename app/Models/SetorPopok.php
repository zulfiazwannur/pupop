<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SetorPopok extends Model
{
    protected $table = 'setor_popok';

    // Aturan nilai (bisa diubah di satu tempat)
    public const POIN_PER_PCS = 2;      // 5 pcs = 10 poin
    public const REWARD_PER_PCS = 200;  // 10 pcs = Rp2.000 untuk mitra
    public const MAKS_PCS = 500;        // batas wajar sekali setor

    protected $fillable = ['user_id', 'lokasi_mitra_id', 'kode', 'jumlah'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function lokasi(): BelongsTo
    {
        return $this->belongsTo(LokasiMitra::class, 'lokasi_mitra_id');
    }

    public function menunggu(): bool
    {
        return $this->status === 'menunggu';
    }
}
