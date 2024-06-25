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
        Schema::create('questions_templates_ar_data_questions_templates_ar_pivote', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('question_id')->nullable();
            $table->unsignedBigInteger('dataquestion_id')->nullable();
            $table->foreign('question_id')->references('id')->on('questions_templates_analisis_riesgo')->onDelete('cascade');
            $table->foreign('dataquestion_id')->references('id')->on('data_questions_templates_analisis_riesgo')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions_templates_ar_data_questions_templates_ar_pivote');
    }
};
