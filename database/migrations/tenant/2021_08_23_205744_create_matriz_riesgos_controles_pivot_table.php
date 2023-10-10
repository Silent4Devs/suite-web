<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatrizRiesgosControlesPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matriz_riesgos_controles_pivot', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('matriz_id');
            $table->unsignedBigInteger('controles_id');
            $table->foreign('matriz_id')->references('id')->on('matriz_riesgos')->onDelete('cascade');
            $table->foreign('controles_id')->references('id')->on('declaracion_aplicabilidad')->onDelete('cascade');
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
        Schema::dropIfExists('matriz_riesgos_controles_pivot');
    }
}
