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
            //
            $table->unsignedBigInteger('ev_analisis_template_id');

            $table->foreign('ev_analisis_template_id')->references('id')->on('evaluacion_templates_analisis_brechas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('respuestas_evaluacion_analisis_brechas', function (Blueprint $table) {
            //
            $table->dropConstrainedForeignId('ev_analisis_template_id');
        });
    }
};
