<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role', 20)->default('pelanggan')->after('password'); // pelanggan | mitra
            $table->string('lokasi', 255)->nullable()->after('role');           // alamat di profil
            $table->unsignedInteger('poin')->default(0)->after('lokasi');
            $table->unsignedBigInteger('saldo')->default(0)->after('poin');     // rupiah (mitra)
            $table->foreignId('mitra_pilihan_id')->nullable()->after('saldo')
                ->constrained('lokasi_mitra')->nullOnDelete();                  // mitra favorit pelanggan
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropConstrainedForeignId('mitra_pilihan_id');
            $table->dropColumn(['role', 'lokasi', 'poin', 'saldo']);
        });
    }
};
