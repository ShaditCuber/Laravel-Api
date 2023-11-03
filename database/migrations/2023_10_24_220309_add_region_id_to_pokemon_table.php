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
    Schema::table('pokemon', function (Blueprint $table) {
        $table->unsignedBigInteger('region_id')->nullable()->after('id'); // Asume que quieres la columna después de 'id'
        $table->foreign('region_id')->references('id')->on('regions')->onDelete('set null'); // Establece una clave foránea
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
   public function down()
{
    Schema::table('pokemon', function (Blueprint $table) {
        $table->dropForeign(['region_id']); // Elimina la clave foránea
        $table->dropColumn('region_id'); // Elimina la columna
    });
}

};
