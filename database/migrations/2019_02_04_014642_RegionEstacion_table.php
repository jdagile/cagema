<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RegionesEstacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regionesestaciones', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('estaciones_id')->references('id')->on('estaciones');
          $table->integer('region_id')->references('id')->on('region');
          $table->boolean('estaactivo');
          $table->integer('id_usuariocreo')->references('id')->on('users');
          $table->integer('id_usuariomodifico')->nullable();
          $table->timestamps();
        });
    }

    /**s
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('regionesestaciones');
    }
}
