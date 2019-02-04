<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstacionesAlertasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('estacionesalertas', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('valoreselementos_id')->references('id')->on('valoreselementos');
        $table->integer('tipodealerta_id')->references('id')->on('tipodealerta');
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
        Schema::drop('estacionesalertas');
    }
}
