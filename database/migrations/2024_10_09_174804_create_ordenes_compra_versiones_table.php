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
        Schema::create('orden_compra_versiones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('orden_compra_id');
            $table->unsignedBigInteger('historial_oc_id');
            $table->timestamps();

            // Relaciones
            $table->foreign('orden_compra_id')->references('id')->on('requisiciones')->onDelete('cascade');
            $table->foreign('historial_oc_id')->references('id')->on('historial_ediciones_oc')->onDelete('cascade');
        });

        Schema::create('historial_ediciones_o_c_s', function (Blueprint $table) {
            $table->unsignedBigInteger('version_id')->nullable();

            // Relación con la tabla de versiones
            $table->foreign('version_id')->references('id')->on('orden_compra_versiones')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordenes_compra_versiones');
    }
};
