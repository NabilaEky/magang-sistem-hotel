<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('keluhan_admins', function (Blueprint $table) {
            $table->unsignedBigInteger('complaint_id')->nullable()->after('id');

            // 🔥 foreign key (opsional tapi bagus)
            $table->foreign('complaint_id')
                ->references('id')
                ->on('complaints')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('keluhan_admins', function (Blueprint $table) {
            $table->dropForeign(['complaint_id']);
            $table->dropColumn('complaint_id');
        });
    }
};
