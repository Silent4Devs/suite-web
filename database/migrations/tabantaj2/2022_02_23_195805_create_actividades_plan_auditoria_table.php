<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActividadesPlanAuditoriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividades_plan_auditoria', function (Blueprint $table) {
            $table->id();
            $table->string('actividad_auditar')->nullable();
            $table->date('fecha_act_auditoria')->nullable();
            $table->time('hora_inicio')->nullable();
            $table->time('hora_fin')->nullable();
            $table->unsignedInteger('id_contacto')->after('id')->nullable();
            $table->unsignedInteger('plan_auditoria_id')->after('id')->nullable();
            $table->foreign('plan_auditoria_id')->references('id')->on('plan_auditoria')->onDelete('SET NULL')->onUpdate('cascade');
            $table->foreign('id_contacto')->references('id')->on('empleados')->onDelete('SET NULL')->onUpdate('cascade');
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
        Schema::dropIfExists('actividades_plan_auditoria');
    }
}
