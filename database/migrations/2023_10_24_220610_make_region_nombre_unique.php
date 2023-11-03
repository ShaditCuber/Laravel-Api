<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up()
{
    Schema::table('regions', function (Blueprint $table) {
        $table->unique('region_name');
    });
}

public function down()
{
    Schema::table('regions', function (Blueprint $table) {
        $table->dropUnique(['region_name']);
    });
}

};
