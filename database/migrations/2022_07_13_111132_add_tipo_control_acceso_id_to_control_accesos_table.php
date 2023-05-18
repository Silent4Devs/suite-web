<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTipoControlAccesoIdToControlAccesosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('control_accesos', function (Blueprint $table) {
            $table->unsignedBigInteger('tipo_control_acceso_id')->nullable();
            $table->unsignedBigInteger('responsable_id')->nullable();
            $table->longText('justificacion')->nullable();
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->foreign('tipo_control_acceso_id')->references('id')->on('tipo_permiso');
            $table->foreign('responsable_id')->references('id')->on('empleados');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('control_accesos', function (Blueprint $table) {
            //
        });
    }
}
