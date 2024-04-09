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
        Schema::create('evaluadores_evaluacion_competencias_desempenos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('evaluado_desempeno_id');
            $table->unsignedBigInteger('evaluador_desempeno_id');
            $table->double('porcentaje_competencias');
            $table->boolean('finalizada')->default('false');
            $table->text('firma_evaluacion')->nullable();

            $table->foreign('evaluado_desempeno_id')->references('id')->on('evaluados_evaluacion_desempenos')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('evaluador_desempeno_id')->references('id')->on('empleados')->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluadores_evaluacion_competencias_desempenos');
    }
};
