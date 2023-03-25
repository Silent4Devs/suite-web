<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatrizOctaveEscenarioControlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matriz_octave_escenario_controles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_matriz_octave_escenarios')->nullable();
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
        Schema::dropIfExists('matriz_octave_escenario_controles');
    }
}
