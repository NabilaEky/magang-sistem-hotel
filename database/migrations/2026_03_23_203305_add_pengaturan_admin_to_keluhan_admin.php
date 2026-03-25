<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('keluhan_admins', function (Blueprint $table) {

            if (!Schema::hasColumn('keluhan_admins', 'petugas')) {
                $table->string('petugas')->nullable();
            }

            if (!Schema::hasColumn('keluhan_admins', 'status')) {
                $table->string('status')->default('Pending');
            }

            if (!Schema::hasColumn('keluhan_admins', 'prioritas')) {
                $table->string('prioritas')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('keluhan_admins', function (Blueprint $table) {
            $table->dropColumn(['petugas', 'status', 'prioritas']);
        });
    }
};
