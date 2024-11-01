<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluacionObjetivoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluacion_objetivo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no')->nullable();
            $table->string('evaluacion')->nullable();
            $table->date('fecha')->nullable();
            $table->integer('resultado')->nullable();
            $table->unsignedInteger('id_objetivo')->nullable();
            $table->foreign('id_objetivo')->references('id')->on('objetivosseguridads');
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
        Schema::dropIfExists('evaluacion_objetivo');
    }
}
