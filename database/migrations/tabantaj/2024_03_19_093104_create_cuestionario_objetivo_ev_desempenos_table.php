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
        Schema::create('cuestionario_objetivo_ev_desempenos', function (Blueprint $table) {
            $table->id();
            $table->integer('objetivo_id');
            $table->integer('periodo_id');
            $table->boolean('aplicabilidad')->default(true);

            $table->integer('evaluacion_desempeno_id');
            $table->integer('evaluado_desempeno_id');
            $table->integer('evaluador_desempeno_id');

            $table->double('calificacion_objetivo')->nullable();
            $table->boolean('estatus_calificado')->default(false);

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('objetivo_id')->references('id')->on('catalogo_objetivos_ev_desempenos')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('periodo_id')->references('id')->on('periodos_evaluacion_desempenos')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('evaluacion_desempeno_id')->references('id')->on('evaluacion_desempenos')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('evaluado_desempeno_id')->references('id')->on('evaluados_evaluacion_desempenos')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('evaluador_desempeno_id')->references('id')->on('evaluadores_evaluacion_objetivos_desempenos')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuestionario_objetivo_ev_desempenos');
    }
};
