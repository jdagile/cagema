<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCorrelacionMaestroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('correlacionmaestro');
      Schema::create('correlacionmaestro', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('tipodeproducto_id')->references('id')->on('tipodeproducto');
        $table->integer('fasefenologica_id')->references('id')->on('fasefenologica');
        $table->integer('alertasgenerales_id')->references('id')->on('alertasgenerales');
        $table->string('descripcion',200);
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
      Schema::drop('correlacionmaestro');

    }
}
