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
        Schema::create('template_ar_prob_imp_ar_pivote', function (Blueprint $table) {
            $table->id();
            $table->integer('template_id')->nullable();
            $table->float('valor_min', 32, 2);
            $table->float('valor_max', 32, 2);
            $table->foreign('template_id')->references('id')->on('template_analisis_riesgos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('template_ar_prob_imp_ar_pivote');
    }
};
