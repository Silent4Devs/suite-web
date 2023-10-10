<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatrizOctaveContenedoresEscenariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matriz_octave_contenedores_escenarios', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('id_octave_escenario')->nullable();
            $table->foreign('id_octave_escenario')->references('id')->on('matriz_octave_escenarios');
            $table->unsignedInteger('id_octave_contenedor')->nullable();
            $table->foreign('id_octave_contenedor')->references('id')->on('matriz_octave_contenedores');
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
        Schema::dropIfExists('matriz_octave_contenedores_escenarios');
    }
}
