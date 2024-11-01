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
        Schema::table('ev360_competencias_respuestas', function (Blueprint $table) {
            //
            $table->integer('calificacion')->nullable()->default(null)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ev360_competencias_respuestas', function (Blueprint $table) {
            //
            $table->integer('calificacion')->default(0)->change(); // Change the default value as needed
        });
    }
};
