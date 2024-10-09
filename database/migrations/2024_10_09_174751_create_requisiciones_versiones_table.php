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
        Schema::create('requisicion_versiones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('requisicion_id');
            $table->unsignedBigInteger('historial_requisicion_id');
            $table->timestamps();

            // Relaciones
            $table->foreign('requisicion_id')->references('id')->on('requisiciones')->onDelete('cascade');
            $table->foreign('historial_requisicion_id')->references('id')->on('historial_ediciones_req')->onDelete('cascade');
        });

        Schema::create('historial_ediciones_req', function (Blueprint $table) {
            $table->unsignedBigInteger('version_id')->nullable();

            // Relación con la tabla de versiones
            $table->foreign('version_id')->references('id')->on('requisicion_versiones')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requisiciones_versiones');
    }
};
