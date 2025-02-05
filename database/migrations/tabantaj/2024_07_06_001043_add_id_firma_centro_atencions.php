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
        Schema::table('firma_centro_atencions', function (Blueprint $table) {

            $table->integer('id_seguridad')->nullable();
            $table->foreign('id_seguridad')->references('id')->on('incidentes_seguridad')->onUpdate('cascade')->onDelete('cascade');

            $table->integer('id_riesgos')->nullable();
            $table->foreign('id_riesgos')->references('id')->on('riesgos_identificados')->onUpdate('cascade')->onDelete('cascade');

            $table->integer('id_quejas')->nullable();
            $table->foreign('id_quejas')->references('id')->on('quejas')->onUpdate('cascade')->onDelete('cascade');

            $table->integer('id_mejoras')->nullable();
            $table->foreign('id_mejoras')->references('id')->on('mejoras')->onUpdate('cascade')->onDelete('cascade');

            $table->integer('id_denuncias')->nullable();
            $table->foreign('id_denuncias')->references('id')->on('denuncias')->onUpdate('cascade')->onDelete('cascade');

            $table->integer('id_sugerencias')->nullable();
            $table->foreign('id_sugerencias')->references('id')->on('sugerencias')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
