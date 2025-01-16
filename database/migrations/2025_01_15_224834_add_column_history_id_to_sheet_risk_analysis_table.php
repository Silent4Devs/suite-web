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
        Schema::table('sheet_risk_analysis', function (Blueprint $table) {
            $table->unsignedBigInteger('history_id')->nullable();

            // Relación con la tabla de versiones
            $table->foreign('history_id')->references('id')->on('versions_sheet_risk_analysis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sheet_risk_analysis', function (Blueprint $table) {
            $table->dropColumn('history_id');
        });
    }
};
