<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MunicipiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('municipios', function (Blueprint $table) {
          $table->integer('id')->primary();
          $table->string('descripcion',100);
          $table->integer('departamento_id')->references('id')->on('departamento');
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
        Schema::drop('municipios');
    }
}
