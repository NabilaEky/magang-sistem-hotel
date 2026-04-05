<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('keluhan_custs', function (Blueprint $table) {
            $table->json('foto')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('keluhan_custs', function (Blueprint $table) {
            $table->string('foto')->nullable()->change();
        });
    }
};
