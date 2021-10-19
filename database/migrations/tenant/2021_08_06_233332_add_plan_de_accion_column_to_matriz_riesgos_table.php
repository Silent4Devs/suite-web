<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPlanDeAccionColumnToMatrizRiesgosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('matriz_riesgos', function (Blueprint $table) {
            $table->string('plan_de_accion')->nullable();
            $table->string('confidencialidad_cid')->nullable();
            $table->string('integridad_cid')->nullable();
            $table->string('disponibilidad_cid')->nullable();
            $table->string('probabilidad_residual')->nullable();
            $table->string('impacto_residual')->nullable();
            $table->string('nivelriesgo_residual')->nullable();
            $table->string('riesgo_total_residual')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('matriz_riesgos', function (Blueprint $table) {
            //
        });
    }
}
