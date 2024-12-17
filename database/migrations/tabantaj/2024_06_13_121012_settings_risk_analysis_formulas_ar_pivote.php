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
        Schema::create('settings_risk_analysis_formulas_ar_pivote', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('risk_analysis_id')->nullable();
            $table->unsignedBigInteger('formula_id')->nullable();
            $table->boolean('is_show')->default(false);
            $table->foreign('risk_analysis_id')->references('id')->on('risk_analysis')->onDelete('cascade');
            $table->foreign('formula_id')->references('id')->on('formulas_risk_analysis')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings_risk_analysis_formulas_ar_pivote');
    }
};
