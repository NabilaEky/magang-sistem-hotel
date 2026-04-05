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
        Schema::create('me_repairs', function (Blueprint $table) {
            $table->id();
            $table->date('tgl');
            $table->string('lokasi');
            $table->string('pekerjaan');
            $table->string('gambar_temuan')->nullable();
            $table->string('gambar_progress')->nullable();
            $table->string('selesai')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('petugas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('me_repairs');
    }
};
