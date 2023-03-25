<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiesgosIdentificadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riesgos_identificados', function (Blueprint $table) {
            $table->id();
            $table->string('titulo')->nullable();
            $table->date('fecha')->nullable();
            $table->date('fecha_cierre')->nullable();
            $table->string('estatus')->default('nuevo');

            $table->string('sede')->nullable();
            $table->string('ubicacion')->nullable();
            $table->string('descripcion')->nullable();

            $table->string('areas_afectados')->nullable();
            $table->string('procesos_afectados')->nullable();
            $table->string('activos_afectados')->nullable();

            $table->longText('comentarios')->nullable();

            $table->unsignedBigInteger('empleado_reporto_id')->nullable();

            $table->foreign('empleado_reporto_id')->references('id')->on('empleados');

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
        Schema::dropIfExists('riesgos_identificados');
    }
}
