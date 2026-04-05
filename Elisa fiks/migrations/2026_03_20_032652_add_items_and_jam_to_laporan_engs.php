<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('laporan_engs', function (Blueprint $table) {

        if (!Schema::hasColumn('laporan_engs', 'jam_mulai')) {
            $table->time('jam_mulai')->nullable()->after('status');
        }

        if (!Schema::hasColumn('laporan_engs', 'jam_selesai')) {
            $table->time('jam_selesai')->nullable()->after('jam_mulai');
        }

    });
}
};