<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActividadesAccionCorrectivaResponsablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividades_accion_correctiva_responsables', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('responsable_id');
            $table->unsignedBigInteger('actividad_id');
            $table->timestamps();
            $table->foreign('responsable_id')->references('id')->on('empleados');
            $table->foreign('actividad_id')->references('id')->on('actividades_accion_correctiva');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actividades_accion_correctiva_responsables');
    }
}
