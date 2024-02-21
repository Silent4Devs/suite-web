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
        Schema::table('respuestas_evaluacion_analisis_brechas', function (Blueprint $table) {
            // Eliminar la foreign key existente
            $table->dropForeign(['pregunta_id']);
            $table->dropForeign(['parametro_id']);
            $table->dropForeign(['ev_analisis_template_id']);

            // Agregar la nueva foreign key
            $table->foreign('pregunta_id')->references('id')->on('preguntas_evaluacion_analisis_brechas')->onDelete('cascade');
            $table->foreign('parametro_id')->references('id')->on('parametros_evaluacion_analisis_brechas')->onDelete('cascade');
            $table->foreign('ev_analisis_template_id')->references('id')->on('evaluacion_analisis_brechas')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
