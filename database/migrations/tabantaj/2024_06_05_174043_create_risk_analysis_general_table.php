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
        Schema::create('risk_analysis_general', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('fecha');
            $table->boolean('status')->default(false);
            $table->unsignedBigInteger('elaboro_id')->nullable();
            $table->unsignedBigInteger('norma_id')->nullable();
            $table->unsignedBigInteger('template_id')->nullable();
            $table->foreign('elaboro_id')->references('id')->on('empleados');
            $table->foreign('norma_id')->references('id')->on('normas');
            $table->foreign('template_id')->references('id')->on('template_analisis_riesgos');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('risk_analysis_general');
    }
};
