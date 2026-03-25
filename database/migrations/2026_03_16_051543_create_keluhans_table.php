<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('riwayat_keluhan', function (Blueprint $table) {
            $table->id();
            $table->string('waktu'); // misal jam keluhan
            $table->string('jenis_masalah');
            $table->string('lokasi');
            $table->string('petugas');
            $table->string('prioritas')->nullable();
            $table->string('status')->default('Pending');
            $table->date('tanggal_selesai')->nullable();
            $table->timestamps(); // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('riwayat_keluhan');
    }
};