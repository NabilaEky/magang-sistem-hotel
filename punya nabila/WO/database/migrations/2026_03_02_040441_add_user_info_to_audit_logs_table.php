<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('audit_logs', function (Blueprint $table) {

            // Supaya bisa detect akses luar
            $table->foreignId('user_id')
                ->nullable()
                ->change();

            // Tambahan kolom baru
            $table->string('username')->nullable()->after('user_id');
            $table->string('name')->nullable()->after('username');
            $table->string('role')->nullable()->after('name');

            $table->string('user_agent')->nullable()->after('ip_address');
        });
    }

    public function down(): void
    {
        Schema::table('audit_logs', function (Blueprint $table) {
            $table->dropColumn([
                'username',
                'name',
                'role',
                'user_agent'
            ]);
        });
    }
};
