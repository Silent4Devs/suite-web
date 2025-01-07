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
        Schema::table('incidentes_seguridad', function (Blueprint $table) {
            $table->longText('sentimientos')->nullable();
        });

        Schema::table('riesgos_identificados', function (Blueprint $table) {
            $table->longText('sentimientos')->nullable();
        });

        Schema::table('quejas', function (Blueprint $table) {
            $table->longText('sentimientos')->nullable();
        });

        Schema::table('quejas_clientes', function (Blueprint $table) {
            $table->longText('sentimientos')->nullable();
        });

        Schema::table('denuncias', function (Blueprint $table) {
            $table->longText('sentimientos')->nullable();
        });

        Schema::table('mejoras', function (Blueprint $table) {
            $table->longText('sentimientos')->nullable();
        });

        Schema::table('sugerencias', function (Blueprint $table) {
            $table->longText('sentimientos')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('incidentes_seguridad', function (Blueprint $table) {
            $table->dropColumn('sentimientos');
        });

        Schema::table('riesgos_identificados', function (Blueprint $table) {
            $table->dropColumn('sentimientos');
        });

        Schema::table('quejas', function (Blueprint $table) {
            $table->dropColumn('sentimientos');
        });

        Schema::table('quejas_clientes', function (Blueprint $table) {
            $table->dropColumn('sentimientos');
        });

        Schema::table('denuncias', function (Blueprint $table) {
            $table->dropColumn('sentimientos');
        });

        Schema::table('mejoras', function (Blueprint $table) {
            $table->dropColumn('sentimientos');
        });

        Schema::table('sugerencias', function (Blueprint $table) {
            $table->dropColumn('sentimientos');
        });
    }
};
