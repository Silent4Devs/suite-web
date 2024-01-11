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
        Schema::create('evaluacion_analisis_brechas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('analisis_brechas_id');
            $table->string('nombre_evaluacion');
            $table->unsignedBigInteger('norma_id');
            $table->longText('descripcion');
            $table->integer('no_secciones');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('analisis_brechas_id')->references('id')->on('analisis_brechas_isos')->onDelete('cascade');
            $table->foreign('norma_id')->references('id')->on('normas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluacion_analisis_brechas');
    }
};
