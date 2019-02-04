<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLlaveUniqueToValoresAcumuladosPorFaseFenologicaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('valoresacumuladosporfasefenologica', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('tipodeproducto_id')->references('id')->on('tipodeproducto');
        $table->integer('fasefenologica_id')->references('id')->on('fasefenologica');
        $table->integer('elementos_id')->references('id')->on('elementos');
        $table->decimal('valor',18,4) ;
        $table->boolean('estaactivo');
        $table->integer('id_usuariocreo')->references('id')->on('users');
        $table->integer('id_usuariomodifico')->nullable();
        $table->timestamps();
        $table->unique(array('tipodeproducto_id', 'fasefenologica_id' , 'elementos_id'  ));
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('valoresacumuladosporfasefenologica', function (Blueprint $table) {
        Schema::drop('ValoresAcumuladosPorFaseFenologica');
        });
    }
}
