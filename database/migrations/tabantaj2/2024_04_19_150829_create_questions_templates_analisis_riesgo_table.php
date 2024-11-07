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
        Schema::create('questions_templates_analisis_riesgo', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('size');
            $table->string('type');
            $table->integer('position');
            $table->boolean('obligatory')->default(false);
            $table->boolean('is_numeric')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions_templates_analisis_riesgo');
    }
};
