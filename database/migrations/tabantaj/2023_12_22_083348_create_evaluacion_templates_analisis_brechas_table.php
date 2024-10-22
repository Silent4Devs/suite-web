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
        Schema::create('evaluacion_templates_analisis_brechas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('analisis_brechas_id');
            $table->unsignedBigInteger('template_id');

            $table->foreign('analisis_brechas_id')->references('id')->on('analisis_brechas_isos')->onDelete('cascade');
            $table->foreign('template_id')->references('id')->on('template_analisisde_brechas')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluacion_templates_analisis_brechas');
    }
};
