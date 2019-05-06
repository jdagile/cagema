<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPrecipitacionacumuladaToEstacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('estaciones', function (Blueprint $table) {
        $table->boolean('acumulaprecipitacion')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('estaciones', function (Blueprint $table) {
          $table->dropColumn('acumulaprecipitacion');
        });
    }
}
