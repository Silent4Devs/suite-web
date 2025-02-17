<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsOnMatrizRiesgosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('matriz_riesgos', function (Blueprint $table) {
            $table->dropColumn('proceso');
            $table->dropColumn('responsableproceso');
            $table->integer('id_analisis')->nullable();
            $table->foreign('id_analisis')->references('id')->on('analisis_de_riesgo');
            $table->integer('id_sede')->nullable();
            $table->foreign('id_sede')->references('id')->on('sedes');
            $table->integer('id_proceso')->nullable();
            $table->foreign('id_proceso')->references('id')->on('procesos');
            $table->integer('id_responsable')->nullable();
            $table->foreign('id_responsable')->references('id')->on('empleados');
            $table->integer('activo_id')->nullable();
            $table->foreign('activo_id')->references('id')->on('activos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
