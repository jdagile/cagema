<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('estaciones', function (Blueprint $table) {
        $table->integer('id');
        $table->string('descripcion',200);
        $table->decimal('longitud',7,4) ;
        $table->decimal('latitud',7,4) ;
        $table->integer('elevacion');
        $table->boolean('estaactivo');
        $table->integer('id_usuariocreo')->references('id')->on('users');
        $table->integer('id_usuariomodifico')->nullable();
        $table->timestamps();
        $table->primary(['id']);

      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('estaciones');
    }
}
