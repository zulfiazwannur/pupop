<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Data Usaha: satu mitra = satu data usaha (relasi 1:1).
        Schema::create('data_usaha', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained('users')->cascadeOnDelete();
            $table->string('nama_usaha', 100);
            $table->string('jenis_usaha', 100)->nullable();
            $table->string('telepon', 20)->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('jam_buka', 5)->default('08:00');
            $table->string('jam_tutup', 5)->default('17:00');
            $table->unsignedInteger('kapasitas')->default(100); // kapasitas penampungan (pcs)
            $table->decimal('terisi', 10, 2)->default(0);       // popok yang sedang ditampung (pcs)
            $table->boolean('status_buka')->default(false);     // status operasional
            $table->string('catatan_status', 255)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_usaha');
    }
};
