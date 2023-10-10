<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MatrizIso31000ControlesPivots extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matriz_iso31000_controles_pivots', function (Blueprint $table) {
            $table->increments('id');
            $table->UnsignedInteger('id_matriz')->nullable();
            $table->unsignedInteger('controles_id')->nullable();
            $table->foreign('id_matriz')->references('id')->on('matriz_iso31000');
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
