<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UnidadDeMedidaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('unidaddemedida', function (Blueprint $table) {
       $table->increments('id');
       $table->string('simbolo',8)->unique();
        $table->string('descripcion',100);
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
        Schema::drop('unidaddemedida');
    }
}
