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
        Schema::create('carta_aceptacion_pivots', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('controles_id')->nullable();
            $table->foreign('controles_id')->references('id')->on('declaracion_aplicabilidad');
            $table->unsignedInteger('carta_id')->nullable();
            $table->foreign('carta_id')->references('id')->on('carta_aceptacion');
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
        Schema::dropIfExists('carta_aceptacion_pivots');
    }
}
