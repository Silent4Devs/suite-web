<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnCalificacionPersepcionToEv360ObjetivosCalificacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ev360_objetivos_calificaciones', function (Blueprint $table) {
            $table->smallInteger('calificacion_persepcion')->default(3);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ev360_objetivos_calificaciones', function (Blueprint $table) {
            //
        });
    }
}
