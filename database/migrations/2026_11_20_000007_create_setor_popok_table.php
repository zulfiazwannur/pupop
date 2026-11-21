<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('setor_popok', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('lokasi_mitra_id')->nullable()->constrained('lokasi_mitra')->nullOnDelete();
            $table->string('kode', 12)->unique();                 // kode setor (untuk QR / verifikasi)
            $table->unsignedInteger('jumlah');                    // pcs
            $table->unsignedInteger('poin_didapat')->default(0);  // terisi saat diterima mitra
            $table->string('status', 15)->default('menunggu');    // menunggu | diterima
            $table->timestamp('diterima_pada')->nullable();
            $table->timestamps();
            $table->index(['lokasi_mitra_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('setor_popok');
    }
};
