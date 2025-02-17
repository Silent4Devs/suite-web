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
        Schema::create('escalas_analisis_riesgos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->float('valor', 8, 2);
            $table->string('color');
            $table->boolean('riesgo_aceptable')->default(false);
            $table->integer('min_max_id');
            $table->foreign('min_max_id')->references('id')->on('template_ar__escalas_ar_pivote')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('escalas_analisis_riesgos');
    }
};
