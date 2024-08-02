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
        Schema::create('answers_sheet_risk_analysis_pivote', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sheet_id')->nullable();
            $table->unsignedBigInteger('answer_id')->nullable();
            $table->foreign('sheet_id')->references('id')->on('sheet_risk_analysis')->onDelete('cascade');
            $table->foreign('answer_id')->references('id')->on('answers_sheet_risk_analysis')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answers_sheet_risk_analysis_pivote');
    }
};
