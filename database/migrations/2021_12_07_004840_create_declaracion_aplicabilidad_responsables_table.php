<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeclaracionAplicabilidadResponsablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('declaracion_aplicabilidad_responsables', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('declaracion_id')->nullable();
            $table->unsignedBigInteger('empleado_id')->nullable();
            $table->string('aplica')->nullable();
            $table->longText('justificacion')->nullable();
            $table->foreign('empleado_id')->references('id')->on('empleados')->nullable();
            $table->foreign('declaracion_id')->references('id')->on('declaracion_aplicabilidad')->nullable();
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
        Schema::dropIfExists('declaracion_aplicabilidad_responsables');
    }
}
