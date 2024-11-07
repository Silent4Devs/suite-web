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
        Schema::table('historial_ediciones_req', function (Blueprint $table) {
            //
            $table->integer('version_id')->nullable();

            // Relación con la tabla de versiones
            $table->foreign('version_id')->references('id')->on('versiones_requisicion')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('historial_ediciones_req', function (Blueprint $table) {
            //
            $table->dropColumn('version_id');

            // Relación con la tabla de versiones
            $table->foreign('version_id')->references('id')->on('versiones_requisicion')->onDelete('cascade');
        });
    }
};
