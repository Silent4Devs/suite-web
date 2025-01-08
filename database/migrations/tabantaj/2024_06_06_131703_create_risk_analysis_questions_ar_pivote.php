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
        Schema::create('risk_analysis_questions_ar_pivote', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('risk_analysis_id')->nullable();
            $table->unsignedBigInteger('question_id')->nullable();
            $table->boolean('is_show')->default(false);
            $table->foreign('risk_analysis_id')->references('id')->on('risk_analysis')->onDelete('cascade');
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
        Schema::dropIfExists('risk_analysis_questions_ar_pivote');
    }
};
