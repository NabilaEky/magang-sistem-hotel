<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('riwayat_departments', function (Blueprint $table) {
            $table->id();
            $table->timestamp('waktu')->useCurrent(); // otomatis waktu
            $table->string('lokasi');
            $table->string('jenis_masalah');
            $table->string('status'); // Pending / Proses / Selesai
            $table->string('petugas')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('riwayat_departments');
    }
};
