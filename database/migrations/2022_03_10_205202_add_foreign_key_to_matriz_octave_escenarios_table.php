<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToMatrizOctaveEscenariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('matriz_octave_escenarios', function (Blueprint $table) {
            $table->unsignedInteger('id_octave_contenedor')->nullable();
            $table->foreign('id_octave_contenedor')->references('id')->on('matriz_octave_contenedores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('matriz_octave_escenarios', function (Blueprint $table) {
            //
        });
    }
}
