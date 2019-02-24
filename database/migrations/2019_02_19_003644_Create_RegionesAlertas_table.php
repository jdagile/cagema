<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegionesAlertasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regionesalertas', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('region_id')->references('id')->on('region');
          $table->integer('alertasgenerales_id')->references('id')->on('alertasgenerales');
          $table->integer('dia');//aumenta la rapides en las consultas los tipos de  datos enteros respecto al datetime
          $table->integer('mes');
          $table->integer('anio');
          $table->boolean('estaactivo');
          $table->integer('id_usuariocreo')->references('id')->on('users');
          $table->integer('id_usuariomodifico')->nullable();
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('regionesalertas');
    }
}
