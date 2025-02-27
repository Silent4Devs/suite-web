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
            $table->boolean('no_aplica')->default(false);
            $table->longText('justificacion')->nullable()->default('text');
            $table->unsignedBigInteger('id_rango_indicadores_sgsi')->nullable();

            $table->foreign('id_rango_indicadores_sgsi')->references('id')->on('rangos_indicadores_s_g_s_i_s')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('evaluacion_indicador', function (Blueprint $table) {
            $table->dropColumn('no_aplica');
            $table->dropColumn('justificacion');
            $table->dropForeign(['id_rango_indicadores_sgsi']);
            $table->dropColumn('id_rango_indicadores_sgsi');
        });
    }

};
