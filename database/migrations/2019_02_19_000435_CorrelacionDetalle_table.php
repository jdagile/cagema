<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorrelacionDetalleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('correlaciondetalle', function (Blueprint $table) {
            $table->increments('id');            
            $table->integer('correlacionmaestro_id')->references('id')->on('correlacionmaestro');
            $table->integer('elementos_id')->references('id')->on('elementos');
            $table->integer('tipodealerta_id')->references('id')->on('tipodealerta');
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
        Schema::drop('correlaciondetalle');
    }
}
