<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MatrizOctaveControlesPivots extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matriz_octave_controles_pivots', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_matriz')->nullable();
            $table->integer('controles_id')->nullable();
            $table->foreign('id_matriz')->references('id')->on('matriz_octave');
            $table->foreign('controles_id')->references('id')->on('declaracion_aplicabilidad');
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
        //
    }
}
