<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('keluhan_admins', function (Blueprint $table) {
            $table->id(); // ID
            $table->time('waktu'); // Waktu
            $table->string('lokasi'); // Lokasi
            $table->string('jenis_masalah'); // Jenis Masalah
            $table->string('prioritas'); // Prioritas
            $table->string('status')->default('baru'); // Status
            $table->string('petugas'); // Nama petugas
            $table->unsignedBigInteger('work_order_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keluhan_admins');
    }
};
