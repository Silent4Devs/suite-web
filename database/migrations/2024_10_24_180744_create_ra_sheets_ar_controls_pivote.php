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
        Schema::create('ra_sheets_ar_controls_pivote', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sheet_id')->nullable();
            $table->unsignedBigInteger('control_sheet_id')->nullable();
            $table->foreign('sheet_id')->references('id')->on('sheet_risk_analysis')->onDelete('cascade');
            $table->foreign('control_sheet_id')->references('id')->on('risk_analysis_controls')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ra_sheets_ar_controls_pivote');
    }
};
