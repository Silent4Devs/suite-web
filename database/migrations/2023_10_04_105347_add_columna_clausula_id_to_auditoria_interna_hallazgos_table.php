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
        Schema::table('auditoria_internas_hallazgos', function (Blueprint $table) {
            //
            $table->unsignedInteger('clausula_id')->nullable();
            $table->foreign('clausula_id')->references('id')->on('clausulas_auditorias');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('auditoria_internas_hallazgos', function (Blueprint $table) {
            //
        });
    }
};
