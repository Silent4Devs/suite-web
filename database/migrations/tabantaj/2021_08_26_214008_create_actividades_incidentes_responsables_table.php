<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActividadesIncidentesResponsablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividades_incidentes_responsables', function (Blueprint $table) {
            $table->id();
            $table->integer('responsable_id');
            $table->integer('actividad_id');
            $table->timestamps();
            $table->foreign('responsable_id')->references('id')->on('empleados');
            $table->foreign('actividad_id')->references('id')->on('actividades_incidentes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actividades_incidentes_responsables');
    }
}
