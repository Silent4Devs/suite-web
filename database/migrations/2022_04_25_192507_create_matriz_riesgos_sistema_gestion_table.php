<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatrizRiesgosSistemaGestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matriz_riesgos_sistema_gestion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('descripcionriesgo')->nullable();
            $table->string('tipo_riesgo')->nullable();
            $table->string('confidencialidad')->nullable();
            $table->string('integridad')->nullable();
            $table->string('disponibilidad')->nullable();
            $table->string('probabilidad')->nullable();
            $table->string('impacto')->nullable();
            $table->float('nivelriesgo', 5, 2)->nullable();
            $table->float('riesgototal', 5, 2)->nullable();
            $table->decimal('resultadoponderacion', 10, 2)->nullable();
            $table->float('riesgoresidual', 5, 2)->nullable();
            $table->string('justificacion')->nullable();
            $table->unsignedInteger('id_analisis')->nullable();
            $table->unsignedInteger('id_sede')->nullable();
            $table->unsignedInteger('id_proceso')->nullable();
            $table->unsignedBigInteger('id_responsable')->nullable();
            $table->unsignedInteger('activo_id')->nullable();
            $table->unsignedInteger('id_amenaza')->nullable();
            $table->unsignedInteger('id_area')->nullable();
            $table->unsignedInteger('id_vulnerabilidad')->nullable();
            $table->string('plan_de_accion')->nullable();
            $table->string('confidencialidad_cid')->nullable();
            $table->string('integridad_cid')->nullable();
            $table->string('disponibilidad_cid')->nullable();
            $table->string('probabilidad_residual')->nullable();
            $table->string('impacto_residual')->nullable();
            $table->string('nivelriesgo_residual')->nullable();
            $table->string('riesgo_total_residual')->nullable();
            $table->foreign('id_analisis')->references('id')->on('analisis_de_riesgo');
            $table->foreign('id_sede')->references('id')->on('sedes');
            $table->foreign('id_proceso')->references('id')->on('procesos');
            $table->foreign('id_responsable')->references('id')->on('empleados');
            $table->foreign('activo_id')->references('id')->on('subcategoria_activos');
            $table->foreign('id_amenaza')->references('id')->on('amenazas');
            $table->foreign('id_area')->references('id')->on('areas');
            $table->foreign('id_vulnerabilidad')->references('id')->on('vulnerabilidads');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matriz_riesgos_sistema_gestion');
    }
}
