<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMesesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('meses', function (Blueprint $table) {
        $table->increments('id');
        $table->string('descripcion',100);
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
        Schema::drop('meses');
    }
}
