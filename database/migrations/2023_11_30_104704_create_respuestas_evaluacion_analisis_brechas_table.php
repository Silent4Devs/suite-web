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
        Schema::create('respuestas_evaluacion_analisis_brechas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pregunta_id');
            $table->unsignedBigInteger('parametro_id');

            $table->foreign('pregunta_id')->references('id')->on('preguntas_template_analisisde_brechas')->onDelete('cascade');
            $table->foreign('parametro_id')->references('id')->on('parametros_template_analisisde_brechas')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('respuestas_evaluacion_analisis_brechas');
    }
};
