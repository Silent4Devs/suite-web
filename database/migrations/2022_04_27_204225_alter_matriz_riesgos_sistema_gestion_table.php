<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterMatrizRiesgosSistemaGestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('matriz_riesgos_sistema_gestion', function (Blueprint $table) {
            $table->dropColumn('confidencialidad');
            $table->dropColumn('integridad');
            $table->dropColumn('disponibilidad');
            $table->dropColumn('confidencialidad_cid');
            $table->dropColumn('integridad_cid');
            $table->dropColumn('disponibilidad_cid');
            $table->float('calidad_servicio')->nullable();
            $table->float('cliente')->nullable();
            $table->float('estrategia_negocio')->nullable();
            $table->float('disponibilidad_2000')->nullable();
            $table->float('niveles_servicio')->nullable();
            $table->float('continuidad_BCP')->nullable();
            $table->float('confidencialidad_270000')->nullable();
            $table->float('integridad_27000')->nullable();
            $table->float('disponibilidad_27000')->nullable();
            $table->float('resultado_ponderacion')->nullable();
            $table->float('estrategia_negocioRes')->nullable();
            $table->float('calidad_servicioRes')->nullable();
            $table->float('clienteRes')->nullable();
            $table->float('disponibilidad_2000Res')->nullable();
            $table->float('niveles_servicioRes')->nullable();
            $table->float('continuidad_BCPRes')->nullable();
            $table->float('confidencialidad_270000Res')->nullable();
            $table->float('integridad_27000Res')->nullable();
            $table->float('disponibilidad_27000Res')->nullable();
            $table->float('resultado_ponderacionRes')->nullable();
            $table->float('riesgo_total')->nullable();
            $table->float('riesgo_residual')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('matriz_riesgos_sistema_gestion', function (Blueprint $table) {
            //
        });
    }
}
