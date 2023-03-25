<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatrizOctaveEscenariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matriz_octave_escenarios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('identificador_escenario')->nullable();
            $table->string('nom_escenario')->nullable();
            $table->string('descripcion')->nullable();
            $table->integer('confidencialidad')->nullable();
            $table->integer('integridad')->nullable();
            $table->integer('disponibilidad')->nullable();
            $table->string('controles')->nullable();
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
        Schema::dropIfExists('matriz_octave_escenarios');
    }
}
