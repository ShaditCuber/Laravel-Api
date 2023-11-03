<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('regions', function (Blueprint $table) {
        $table->string('region_name')->after('id');  // Esto agregará una columna de tipo VARCHAR llamada 'region_name' después de la columna 'id'
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
{
    Schema::table('regions', function (Blueprint $table) {
        $table->dropColumn('region_name');  // Esto eliminará la columna 'region_name'
    });
}

};
