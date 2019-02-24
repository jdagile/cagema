<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDepMuniCuenEsacuEstacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('estaciones', function (Blueprint $table) {
           $table->string('departamentos_codigo',2)->after('elevacion')->nullable();
           $table->string('municipios_codigo',4)->after('departamentos_codigo')->nullable();
           $table->string('municipios_codigo',4)->after('departamentos_codigo')->nullable();
           $table->string('cuencas_codigo',4)->after('municipios_codigo')->nullable();
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
              $table->dropColumn('unidaddemedida_simbolo');
        });
    }
}
