<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Riwayat Transaksi Mitra
        Schema::create('transaksi_mitra', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete(); // pemilik = mitra
            $table->foreignId('setor_popok_id')->nullable()->constrained('setor_popok')->nullOnDelete();
            $table->string('tipe', 10);                       // setor | reward | tarik
            $table->string('sumber', 10)->default('otomatis'); // otomatis | manual
            $table->string('nama', 100);                      // baris tebal: nama user / mitra
            $table->string('keterangan', 255);
            $table->date('tanggal');
            $table->decimal('jumlah_pcs', 10, 2)->default(0);
            $table->unsignedBigInteger('nominal')->default(0);
            $table->unsignedInteger('poin')->default(0);
            $table->timestamps();
            $table->index(['user_id', 'tanggal']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi_mitra');
    }
};
