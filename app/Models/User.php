<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // role, poin, saldo, foto_profil sengaja TIDAK di $fillable:
    // hanya boleh diisi dari kode server (mencegah mass assignment dari form).
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed', // otomatis bcrypt saat disimpan
        ];
    }

    public function isMitra(): bool
    {
        return $this->role === 'mitra';
    }

    public function keranjang(): HasMany
    {
        return $this->hasMany(Keranjang::class);
    }

    public function setoran(): HasMany
    {
        return $this->hasMany(SetorPopok::class);
    }

    public function penukaran(): HasMany
    {
        return $this->hasMany(Penukaran::class);
    }

    public function lokasiMitra(): HasMany
    {
        return $this->hasMany(LokasiMitra::class);
    }

    public function dataUsaha(): HasOne
    {
        return $this->hasOne(DataUsaha::class);
    }

    public function transaksiMitra(): HasMany
    {
        return $this->hasMany(TransaksiMitra::class);
    }

    public function mitraPilihan(): BelongsTo
    {
        return $this->belongsTo(LokasiMitra::class, 'mitra_pilihan_id');
    }

    /** URL foto profil (atau gambar bawaan). */
    public function fotoUrl(string $default = 'img/Ellipse 21.png'): string
    {
        return $this->foto_profil ? asset('storage/' . $this->foto_profil) : asset($default);
    }
}
