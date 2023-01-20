<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEv360RangosResultadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ev360_rangos_resultados', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('inaceptable')->default(60);
            $table->tinyInteger('minimo_aceptable')->default(80);
            $table->tinyInteger('aceptable')->default(100);
            $table->tinyInteger('sobresaliente')->default(100);
            $table->unsignedBigInteger('evaluacion_id');
            $table->foreign('evaluacion_id')->references('id')->on('ev360_evaluaciones')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ev360_rangos_resultados');
    }
}
