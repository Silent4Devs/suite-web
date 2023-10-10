<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToMatrizOctaveEscenarioControlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('matriz_octave_escenario_controles', function (Blueprint $table) {
            $table->unsignedBigInteger('controles_id')->nullable();
            $table->foreign('controles_id')->references('id')->on('declaracion_aplicabilidad');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('matriz_octave_escenario_controles', function (Blueprint $table) {
            //
        });
    }
}
