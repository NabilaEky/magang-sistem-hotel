<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('petugas', function (Blueprint $table) {
            if (!Schema::hasColumn('petugas', 'role')) {
                $table->string('role')->default('petugas')->after('nama');
            }
            if (!Schema::hasColumn('petugas', 'status')) {
                $table->string('status')->default('aktif')->after('role');
            }
            if (!Schema::hasColumn('petugas', 'email')) {
                $table->string('email')->nullable()->after('nama');
            }
            if (!Schema::hasColumn('petugas', 'total_penanganan')) {
                $table->integer('total_penanganan')->default(0)->after('status');
            }
        });
    }

    public function down(): void
    {
        Schema::table('petugas', function (Blueprint $table) {
            if (Schema::hasColumn('petugas', 'role')) {
                $table->dropColumn('role');
            }
            if (Schema::hasColumn('petugas', 'status')) {
                $table->dropColumn('status');
            }
            if (Schema::hasColumn('petugas', 'email')) {
                $table->dropColumn('email');
            }
            if (Schema::hasColumn('petugas', 'total_penanganan')) {
                $table->dropColumn('total_penanganan');
            }
        });
    }
};