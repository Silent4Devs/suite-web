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
        Schema::create('formulas_risk_analysis', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('formula');
            $table->boolean('riesgo')->default(false);
            $table->unsignedBigInteger('risk_analysis_id')->nullable();
            $table->unsignedBigInteger('section_id')->nullable();
            $table->unsignedBigInteger('question_id')->nullable();
            $table->foreign('risk_analysis_id')->references('id')->on('risk_analysis')->onDelete('cascade');
            $table->foreign('section_id')->references('id')->on('sections_risk_analysis')->onDelete('cascade');
            $table->foreign('question_id')->references('id')->on('questions_risk_analysis')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formulas_risk_analysis');
    }
};
