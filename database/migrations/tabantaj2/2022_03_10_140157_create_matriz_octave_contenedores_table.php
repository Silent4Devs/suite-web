<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatrizOctaveContenedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matriz_octave_contenedores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('identificador_contenedor')->nullable();
            $table->string('nom_contenedor')->nullable();
            $table->integer('riesgo')->nullable();
            $table->string('vinculado_ai')->nullable();
            $table->string('descripcion')->nullable();
            $table->unsignedInteger('id_matriz_octave_escenarios')->nullable();
            $table->foreign('id_matriz_octave_escenarios')->references('id')->on('matriz_octave_escenarios');
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
        Schema::dropIfExists('matriz_octave_contenedores');
    }
}
