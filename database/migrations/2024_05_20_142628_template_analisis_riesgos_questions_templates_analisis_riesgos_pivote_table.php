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
        Schema::create('settings_template_ar_questions_templates_ar_pivote_table', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('template_id')->nullable();
            $table->unsignedBigInteger('question_id')->nullable();
            $table->boolean('is_show')->default(false);
            $table->foreign('template_id')->references('id')->on('template_analisis_riesgos')->onDelete('cascade');
            $table->foreign('question_id')->references('id')->on('questions_templates_analisis_riesgo')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('settings_template_ar_questions_templates_ar_pivote_table');

    }
};
