<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Modules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('modules', function (Blueprint $table) {
            $table->increments('id');
            $table->string('module_name');
            $table->string('module_icon');
            $table->string('module_table_name');
            $table->integer('status');
            $table->timestamps();
            $table->timestamp('deleted_at');
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::drop('modules');
    }
}
