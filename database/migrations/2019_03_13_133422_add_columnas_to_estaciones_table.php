<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnasToEstacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('estaciones', function (Blueprint $table) {
          $table->integer('departamentos_id')->after('elevacion')->nullable();
          $table->integer('municipios_id')->after('departamentos_id')->nullable();
          $table->integer('cuencas_id')->after('municipios_id')->nullable();
          $table->integer('perfil_id')->after('cuencas_id')->nullable();
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
            $table->dropColumn('departamentos_id');
            $table->dropColumn('municipios_id');
            $table->dropColumn('cuencas_id');
            $table->dropColumn('perfil_id');
        });
    }
}
