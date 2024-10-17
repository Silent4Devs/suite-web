<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanAuditoriaActividadesAnualsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_auditoria_actividades_anuals', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('actividad_auditar')->nullable();
            $table->date('fecha_auditoria')->nullable();
            $table->time('horario_inicio')->nullable();
            $table->time('horario_termino')->nullable();
            $table->string('nombre_auditor')->nullable();
            $table->unsignedInteger('id_auditado')->nullable();
            $table->unsignedInteger('plan_auditoria_id')->nullable();
            $table->foreign('id_auditado')->references('id')->on('empleados');
            $table->foreign('plan_auditoria_id')->references('id')->on('plan_auditoria');
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
        Schema::dropIfExists('plan_auditoria_actividades_anuals');
    }
}
