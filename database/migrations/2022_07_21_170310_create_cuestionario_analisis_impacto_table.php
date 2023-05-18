<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuestionarioAnalisisImpactoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuestionario_analisis_impacto', function (Blueprint $table) {
            $table->increments('id');
            // DATOS DE IDENTIFICACIÓN DEL ENTREVISTADO
            $table->date('fecha_entrevista')->nullable();
            $table->string('entrevistado')->nullable();
            $table->string('puesto')->nullable();
            $table->string('area')->nullable();
            $table->string('direccion')->nullable();
            $table->integer('extencion')->nullable();
            $table->string('correo')->nullable();
            $table->string('procesos_a_cargo')->nullable();
            // DATOS DE IDENTIFICACIÓN DEL PROCESO
            $table->string('id_proceso')->nullable();
            $table->string('nombre_proceso')->nullable();
            $table->string('version')->nullable();
            $table->string('tipo')->nullable();
            $table->string('objetivo_proceso')->nullable();
            $table->integer('periodicidad')->nullable();
            $table->string('p_otro_txt')->nullable();
            // RESPONSABLES DEL PROCESO
            $table->string('titular_nombre')->nullable();
            $table->string('titular_a_paterno')->nullable();
            $table->string('titular_a_materno')->nullable();
            $table->string('titular_puesto')->nullable();
            $table->string('titular_correo')->nullable();
            $table->integer('titular_extencion')->nullable();
            $table->string('suplente_nombre')->nullable();
            $table->string('suplente_a_paterno')->nullable();
            $table->string('suplente_a_materno')->nullable();
            $table->string('suplente_puesto')->nullable();
            $table->string('suplente_correo')->nullable();
            $table->integer('suplente_extencion')->nullable();
            $table->string('supervisor_nombre')->nullable();
            $table->string('supervisor_a_paterno')->nullable();
            $table->string('supervisor_a_materno')->nullable();
            $table->string('supervisor_puesto')->nullable();
            $table->string('supervisor_correo')->nullable();
            $table->integer('supervisor_extencion')->nullable();
            // FLUJO DEL PROCESO
            $table->string('flujo_q_1')->nullable();
            $table->string('flujo_q_2')->nullable();
            $table->string('flujo_q_4')->nullable();
            $table->integer('periodicidad_diario')->default(0);
            $table->integer('periodicidad_quincenal')->default(0);
            $table->integer('periodicidad_mensual')->default(0);
            $table->integer('periodicidad_otro')->default(0);
            $table->string('periodicidad_flujo_txt')->nullable();
            $table->string('flujo_q_6')->nullable();
            $table->string('flujo_q_7')->nullable();
            $table->string('flujo_q_8')->nullable();
            $table->string('flujo_q_10')->nullable();
            $table->integer('flujo_años')->default(0);
            $table->integer('flujo_meses')->default(0);
            $table->integer('flujo_semanas')->default(0);
            $table->integer('flujo_dias')->default(0);
            $table->integer('flujo_otro')->default(0);
            $table->string('flujo_otro_txt')->nullable();
            // RESPALDOS DE INFORMACIÓN
            $table->string('respaldo_q_20')->nullable();
            $table->string('respaldo_q_21')->nullable();
            $table->string('respaldo_q_22')->nullable();
            $table->string('respaldo_q_23')->nullable();
            // PROBABILIDAD DE INCIDENTES DISRUPTIVOS
            $table->integer('disruptivos_q_1')->default(0);
            $table->integer('disruptivos_q_2')->default(0);
            $table->integer('disruptivos_q_3')->default(0);
            $table->integer('disruptivos_q_4')->default(0);
            $table->integer('disruptivos_q_5')->default(0);
            $table->integer('disruptivos_q_6')->default(0);
            $table->integer('disruptivos_q_7')->default(0);
            $table->integer('disruptivos_q_8')->default(0);
            $table->integer('disruptivos_q_9')->default(0);
            $table->integer('disruptivos_q_10')->default(0);
            $table->integer('disruptivos_q_11')->default(0);
            // RIESGOS E INCIDENTES DISRUPTIVOS
            $table->integer('operacion_q_1')->nullable();
            $table->integer('operacion_q_2')->nullable();
            $table->integer('operacion_q_3')->nullable();
            $table->integer('regulatorio_q_1')->nullable();
            $table->integer('regulatorio_q_2')->nullable();
            $table->integer('regulatorio_q_3')->nullable();
            $table->integer('reputacion_q_1')->nullable();
            $table->integer('reputacion_q_2')->nullable();
            $table->integer('reputacion_q_3')->nullable();
            $table->integer('social_q_1')->nullable();
            $table->integer('social_q_2')->nullable();
            $table->integer('social_q_3')->nullable();
            $table->string('incidentes_q_26')->nullable();
            $table->string('incidentes_q_27')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cuestionario_analisis_impacto');
    }
}
