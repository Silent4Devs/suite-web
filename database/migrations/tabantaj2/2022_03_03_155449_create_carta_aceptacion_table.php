<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartaAceptacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carta_aceptacion', function (Blueprint $table) {
            $table->increments('id');
            $table->string('folio_riesgo')->nullable();
            $table->dateTime('fecharegistro')->nullable();
            $table->dateTime('fechaaprobacion')->nullable();
            $table->unsignedBigInteger('responsable_id')->nullable();
            $table->string('activo_folio')->nullable();
            $table->string('nombre_activo')->nullable();
            $table->string('criticidad_activo')->nullable();
            $table->string('confidencialidad')->nullable();
            $table->longText('descripcion_negocio')->nullable();
            $table->longText('descripcion_tecnologico')->nullable();
            $table->longText('descripcion_riesgo')->nullable();
            $table->integer('legal')->nullable();
            $table->integer('cumplimiento')->nullable();
            $table->integer('operacional')->nullable();
            $table->integer('reputacional')->nullable();
            $table->integer('financiero')->nullable();
            $table->integer('tecnologico')->nullable();
            $table->longText('aceptacion_riesgo')->nullable();
            $table->longText('hallazgo')->nullable();
            $table->longText('controles_compensatorios')->nullable();
            $table->longText('recomendaciones')->nullable();
            $table->unsignedBigInteger('director_resp_id')->nullable();
            $table->date('fecha_aut_direct')->nullable();
            $table->unsignedBigInteger('vp_responsable_id')->nullable();
            $table->date('fecha_vp_aut')->nullable();
            $table->unsignedBigInteger('presidencia_id')->nullable();
            $table->date('fecha_aut_presidencia')->nullable();
            $table->unsignedBigInteger('vice_operaciones_id')->nullable();
            $table->date('fecha_aut_viceoperaciones')->nullable();
            $table->foreign('responsable_id')->references('id')->on('empleados');
            $table->foreign('director_resp_id')->references('id')->on('empleados');
            $table->foreign('vp_responsable_id')->references('id')->on('empleados');
            $table->foreign('presidencia_id')->references('id')->on('empleados');
            $table->foreign('vice_operaciones_id')->references('id')->on('empleados');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carta_aceptacion');
    }
}
