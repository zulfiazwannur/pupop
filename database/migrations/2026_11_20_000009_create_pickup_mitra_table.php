<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pickup_mitra', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('lokasi_mitra_id')->nullable()->constrained('lokasi_mitra')->nullOnDelete();
            $table->date('tanggal');
            $table->string('catatan', 255)->nullable();
            $table->string('status', 10)->default('menunggu'); // menunggu | selesai
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pickup_mitra');
    }
};
