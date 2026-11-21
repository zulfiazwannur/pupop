<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Lokasi Mitra: satu mitra boleh punya banyak lokasi.
        Schema::create('lokasi_mitra', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('nama', 100);
            $table->string('kota', 100);
            $table->string('alamat', 255);
            $table->string('jam_buka', 5)->default('08:00');
            $table->string('jam_tutup', 5)->default('17:00');
            $table->string('gambar')->nullable();          // nama file di public/img
            $table->boolean('aktif')->default(true);
            $table->string('alamat_lama', 255)->nullable(); // diisi saat pindah lokasi
            $table->string('alasan_pindah', 255)->nullable();
            $table->date('tanggal_pindah')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lokasi_mitra');
    }
};
