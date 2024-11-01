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
        Schema::create('secciones_evaluacion_analisis_brechas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('evaluacion_id');
            $table->integer('numero_seccion');
            $table->longText('descripcion');
            $table->unsignedDecimal('porcentaje_seccion');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('evaluacion_id')->references('id')->on('evaluacion_analisis_brechas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('secciones_evaluacion_analisis_brechas');
    }
};
