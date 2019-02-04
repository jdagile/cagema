<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutgoingsmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('outgoingsms',function(Blueprint $table){
            $table->increments('id');
            $table->integer('uid');
            $table->integer('p_gateway');
            $table->integer('p_dst');
            $table->text('p_msg');
            $table->integer('sms_count');
            $table->dateTime('p_datetime');
            $table->integer('p_status');
            $table->integer('unicode');
            $table->string('queue_code');
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
        Schema::drop('outgoingsms');
    }
}
