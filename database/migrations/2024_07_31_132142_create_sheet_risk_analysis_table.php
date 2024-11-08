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
        Schema::create('sheet_risk_analysis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('risk_analysis_id')->nullable();
            $table->boolean('initial_risk_confirm')->nullable();
            $table->boolean('residual_risk_confirm')->nullable();
            $table->boolean('require_treatment_plan')->nullable();
            $table->unsignedBigInteger('treatment_plan_id')->nullable();
            $table->foreign('risk_analysis_id')->references('id')->on('risk_analysis')->onDelete('cascade');
            $table->foreign('treatment_plan_id')->references('id')->on('plan_implementacions')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sheet_risk_analysis');
    }
};
