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
        Schema::create('period_sheet_risk_analysis_pivote', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('period_id')->nullable();
            $table->unsignedBigInteger('sheet_id')->nullable();
            $table->float('initial_risk')->nullable();
            $table->float('residual_risk')->nullable();
            $table->integer('initial_coordinate_y')->nullable();
            $table->integer('initial_coordinate_x')->nullable();
            $table->integer('residual_coordinate_y')->nullable();
            $table->integer('residual_coordinate_x')->nullable();
            $table->foreign('period_id')->references('id')->on('period_risk_analysis')->onDelete('cascade');
            $table->foreign('sheet_id')->references('id')->on('sheet_risk_analysis')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('period_sheet_risk_analysis_pivote');
    }
};
