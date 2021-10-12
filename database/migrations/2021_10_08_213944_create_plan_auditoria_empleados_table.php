<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanAuditoriaEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_auditoria_empleados', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('plan_auditoria_id');
            $table->unsignedBigInteger('empleado_id');
            $table->foreign('plan_auditoria_id')->references('id')->on('plan_auditoria');
            $table->foreign('empleado_id')->references('id')->on('empleados');
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
        Schema::dropIfExists('plan_auditoria_empleados');
    }
}
