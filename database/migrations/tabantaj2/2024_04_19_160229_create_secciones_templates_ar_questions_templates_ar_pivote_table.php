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
        Schema::create('secciones_templates_ar_questions_templates_ar_pivote', function (Blueprint $table) {
            $table->id();
            $table->integer('section_id')->nullable();
            $table->integer('question_id')->nullable();
            $table->foreign('section_id')->references('id')->on('sections_templates_analisis_riesgo')->onDelete('cascade');
            $table->foreign('question_id')->references('id')->on('questions_templates_analisis_riesgo')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('secciones_templates_ar_questions_templates_ar_pivote');
    }
};
