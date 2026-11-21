<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penukaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('lokasi_mitra_id')->nullable()->constrained('lokasi_mitra')->nullOnDelete();
            $table->unsignedInteger('jumlah_item');
            $table->unsignedInteger('total_poin');
            $table->timestamps();
        });

        Schema::create('penukaran_item', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penukaran_id')->constrained('penukaran')->cascadeOnDelete();
            $table->foreignId('produk_id')->nullable()->constrained('produk')->nullOnDelete();
            $table->string('nama', 100);          // salinan nama saat transaksi
            $table->string('kategori', 30);
            $table->unsignedInteger('qty');
            $table->unsignedInteger('poin_satuan');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penukaran_item');
        Schema::dropIfExists('penukaran');
    }
};
