<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cuestionario_competencia_ev_desempenos', function (Blueprint $table) {
            $table->id();
            $table->integer('competencia_id');
            $table->integer('periodo_id');

            $table->integer('evaluacion_desempeno_id');
            $table->integer('evaluado_desempeno_id');
            $table->integer('evaluador_desempeno_id');

            $table->double('calificacion_competencia')->nullable();
            $table->boolean('estatus_calificado')->default(false);

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('competencia_id')->references('id')->on('catalogo_competencias_ev_desempenos')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('periodo_id')->references('id')->on('periodos_evaluacion_desempenos')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('evaluacion_desempeno_id')->references('id')->on('evaluacion_desempenos')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('evaluado_desempeno_id')->references('id')->on('evaluados_evaluacion_desempenos')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('evaluador_desempeno_id')->references('id')->on('evaluadores_evaluacion_competencias_desempenos')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuestionario_competencia_ev_desempenos');
    }
};
