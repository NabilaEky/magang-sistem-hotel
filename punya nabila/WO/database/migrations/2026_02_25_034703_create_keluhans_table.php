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
    Schema::create('keluhans', function (Blueprint $table) {
        $table->id();
        $table->string('jenis_masalah');
        $table->string('kategori');
        $table->string('lokasi');
        $table->text('deskripsi')->nullable();

        $table->foreignId('petugas_id')
              ->nullable()
              ->constrained('users')
              ->nullOnDelete();

        $table->string('status')->default('menunggu');
        $table->string('prioritas')->default('rendah');

        $table->text('catatan_admin')->nullable();
        $table->text('catatan_petugas')->nullable();

        $table->integer('rating')->nullable();
        $table->text('komentar')->nullable();

        $table->timestamp('waktu_selesai')->nullable();

        $table->string('foto1')->nullable();
        $table->string('foto2')->nullable();
        $table->string('foto3')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keluhans');
    }
};
