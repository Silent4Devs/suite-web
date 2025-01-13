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
        Schema::table('ev360_metricas_objetivos', function (Blueprint $table) {
            //
            $table->double('valor_minimo')->nullable();
            $table->double('valor_maximo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ev360_metricas_objetivos', function (Blueprint $table) {
            //
            $table->dropColumn('valor_minimo');
            $table->dropColumn('valor_maximo');
        });
    }
};
