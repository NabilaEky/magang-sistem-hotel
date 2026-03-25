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
        Schema::create('petugas_admins', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('shift'); // pagi, siang, malam
            $table->boolean('petugas_aktif')->default(1); // 1 = aktif, 0 = tidak
            $table->string('status'); // standby, kerja, off
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('petugas_admins');
    }
};
