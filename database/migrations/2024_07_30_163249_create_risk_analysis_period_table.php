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
        Schema::create('period_risk_analysis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('risk_analysis_id')->nullable();
            $table->string('name');
            $table->string('status');
            $table->dateTime('start')->nullable();
            $table->dateTime('end')->nullable();
            $table->foreign('risk_analysis_id')->references('id')->on('risk_analysis')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('period_risk_analysis');
    }
};
