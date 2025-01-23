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
        Schema::table('evaluacion_indicador', function (Blueprint $table) {
            $table->json('valores')->nullable(); // Columna para guardar arreglos como JSON
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('evaluacion_indicador', function (Blueprint $table) {
            $table->dropColumn('valores'); // Revertir el cambio si se hace rollback
        });
    }
};
