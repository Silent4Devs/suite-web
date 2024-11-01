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
        Schema::create('aprobador_seleccionados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('modulo_id')->nullable();
            $table->unsignedBigInteger('submodulo_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('seguridad_id')->nullable();
            $table->unsignedBigInteger('mejoras_id')->nullable();
            $table->unsignedBigInteger('riesgos_id')->nullable();
            $table->unsignedBigInteger('sugerencias_id')->nullable();
            $table->unsignedBigInteger('quejas_id')->nullable();
            $table->unsignedBigInteger('denuncias_id')->nullable();
            $table->jsonb('aprobadores')->nullable();
            $table->timestamps();

            $table->foreign('denuncias_id')->references('id')->on('denuncias')->onDelete('cascade');
            $table->foreign('seguridad_id')->references('id')->on('incidentes_seguridad')->onDelete('cascade');
            $table->foreign('mejoras_id')->references('id')->on('mejoras')->onDelete('cascade');
            $table->foreign('riesgos_id')->references('id')->on('riesgos_identificados')->onDelete('cascade');
            $table->foreign('sugerencias_id')->references('id')->on('sugerencias')->onDelete('cascade');
            $table->foreign('quejas_id')->references('id')->on('quejas')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('modulo_id')->references('id')->on('modulos')->onDelete('cascade');
            $table->foreign('submodulo_id')->references('id')->on('submodulos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aprobador_seleccionados');
    }
};
