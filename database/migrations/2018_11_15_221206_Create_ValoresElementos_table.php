<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateValoresElementosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('valoreselementos', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('estaciones_id')->references('id')->on('estaciones');
         $table->integer('elementos_id')->references('id')->on('elementos');
         $table->string('unidaddemedida_simbolo',8)->references('simbolo')->on('unidaddemedida');
         $table->timestamp('fechaestacion') ;
         $table->decimal('valor',18,4) ;
         $table->boolean('estaactivo');
         $table->integer('dia');
         $table->integer('mes');
         $table->integer('anio');
         $table->timestamps();
         $table->unique(array('estaciones_id', 'elementos_id' , 'fechaestacion'));

      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('valoreselementos');
    }
}
