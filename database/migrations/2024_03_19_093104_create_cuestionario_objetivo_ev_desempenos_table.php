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
            $table->text('objetivo');
            $table->longText('descripcion_objetivo')->nullable();
            $table->text('KPI');
            $table->text('tipo_objetivo');
            $table->string('unidad_objetivo');
            $table->double('valor_maximo_unidad_objetivo');
            $table->double('valor_minimo_unidad_objetivo');
            $table->boolean('aplicabilidad')->default(true);

            $table->unsignedBigInteger('evaluacion_desempeno_id');
            $table->unsignedBigInteger('evaluado_desempeno_id');
            $table->unsignedBigInteger('evaluador_desempeno_id');

            $table->double('calificacion_objetivo')->nullable();
            $table->boolean('estatus_calificado')->default(false);

            $table->timestamps();
            $table->softDeletes();

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
