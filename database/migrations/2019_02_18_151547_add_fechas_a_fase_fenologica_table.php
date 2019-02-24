<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFechasAFaseFenologicaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fasefenologica', function (Blueprint $table) {
          $table->date('fechainicio',2)->after('descripcion')->nullable();
          $table->date('fechafin',4)->after('fechainicio')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fasefenologica', function (Blueprint $table) {
            $table->dropColumn('fechainicio');
              $table->dropColumn('fechafin');
        });
    }
}
