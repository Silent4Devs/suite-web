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
        Schema::create('preguntas_evaluacion_analisis_brechas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('seccion_id');
            $table->longText('pregunta');
            $table->bigInteger('numero_pregunta');
            $table->timestamps();

            $table->foreign('seccion_id')->references('id')->on('secciones_evaluacion_analisis_brechas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('preguntas_evaluacion_analisis_brechas');
    }
};
