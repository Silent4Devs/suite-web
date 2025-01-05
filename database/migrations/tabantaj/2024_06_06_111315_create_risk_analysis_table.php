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
        Schema::create('risk_analysis', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->unsignedBigInteger('norma_id')->nullable();
            $table->unsignedBigInteger('general_id')->nullable();
            $table->longText('descripcion');
            $table->foreign('norma_id')->references('id')->on('normas')->onDelete('cascade');
            $table->foreign('general_id')->references('id')->on('risk_analysis_general')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('risk_analysis');
    }
};
