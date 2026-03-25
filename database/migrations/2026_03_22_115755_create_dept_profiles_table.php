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
        Schema::create('dept_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('role')->default('Department');
            $table->string('email')->unique();
            $table->string('no_hp')->nullable();
            $table->string('username')->unique();
            $table->string('password');
            $table->boolean('notifikasi')->default(true);
            $table->timestamp('last_login')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dept_profiles');
    }
};
