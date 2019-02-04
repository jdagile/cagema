<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductoFaseElementoRangoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('productofaseelementorango', function (Blueprint $table) {

      $table->integer('tipoproducto_id')->references('id')->on('tipoproducto');
      $table->integer('fasefenologica_id')->references('id')->on('fasefenologica');
      $table->integer('elementos_id')->references('id')->on('elementos');
      $table->integer('tipodevalor_id',8)->references('id')->on('tipodevalor');
      $table->string('unidaddemedida_simbolo',8)->after('elementos_id')->nullable();
      $table->integer('tipodealerta_id')->nullable();
      $table->decimal('valorminimo',18,4) ;
      $table->decimal('valormaximo',18,4) ;
      $table->boolean('estaactivo');

      $table->timestamps();
      $table->unique(array('tipoproducto_id', 'fasefenologica_id' , 'elementos_id' ,'tipodealerta_id' ,'tipodevalor_id','unidaddemedida_simbolo'     ));

    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('productofaseelementorango');
    }
}
