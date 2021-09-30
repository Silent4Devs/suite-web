<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEv360EmpleadosGruposEvaluadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ev360_empleados_grupos_evaluados', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('grupo_id');
            $table->unsignedBigInteger('empleado_id');
            $table->foreign('grupo_id')->references('id')->on('ev360_grupos_evaluados')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('empleado_id')->references('id')->on('empleados')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('ev360_empleados_grupos_evaluados');
    }
}
