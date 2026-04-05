<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->id();
            $table->string('lokasi');            // Lokasi keluhan
            $table->string('petugas');           // Nama petugas
            $table->tinyInteger('rating');       // Rating 1-5
            $table->text('komentar')->nullable();// Komentar opsional
            $table->date('tanggal');             // Tanggal feedback
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('feedbacks');
    }
};
