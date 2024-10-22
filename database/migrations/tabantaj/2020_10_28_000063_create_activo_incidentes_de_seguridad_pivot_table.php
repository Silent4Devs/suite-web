<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivoIncidentesDeSeguridadPivotTable extends Migration
{
    public function up()
    {
        Schema::create('activo_incidentes_de_seguridad', function (Blueprint $table) {
            $table->unsignedInteger('incidentes_de_seguridad_id');
            $table->foreign('incidentes_de_seguridad_id', 'incidentes_de_seguridad_id_fk_2484321')->references('id')->on('incidentes_de_seguridads')->onDelete('cascade');
            $table->unsignedInteger('activo_id');
            $table->foreign('activo_id', 'activo_id_fk_2484321')->references('id')->on('activos')->onDelete('cascade');
        });
    }
}
