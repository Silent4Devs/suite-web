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
        Schema::table('questions_templates_analisis_riesgo', function (Blueprint $table) {
            $table->string('uuid_formula')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('questions_templates_analisis_riesgo', function (Blueprint $table) {
            $table->dropColumn('uuid_formula');
        });
    }
};
