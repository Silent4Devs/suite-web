<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartaAceptacionPivots extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('carta_aceptacion_pivots', function (Blueprint $table) {
            // $table->increments('id');
            // $table->unsignedInteger('controles_id')->nullable();
            // $table->foreign('controles_id')->references('id')->on('declaracion_aplicabilidad');
            // $table->unsignedInteger('id_matriz_octave_escenarios')->nullable();
            // $table->foreign('id_matriz_octave_escenarios')->references('id')->on('matriz_octave_escenarios');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carta_aceptacion_pivots');
    }
}
