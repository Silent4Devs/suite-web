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
            $table->unsignedInteger('reporte_id')->nullable();
            $table->foreign('reporte_id')->references('id')->on('auditoria_internas_reportes');
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
