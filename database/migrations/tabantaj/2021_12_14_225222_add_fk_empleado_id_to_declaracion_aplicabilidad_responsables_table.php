<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFkEmpleadoIdToDeclaracionAplicabilidadResponsablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('declaracion_aplicabilidad_responsables', function (Blueprint $table) {
            $table->foreign('empleado_id')->references('id')->on('empleados')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('declaracion_aplicabilidad_responsables', function (Blueprint $table) {
            //
        });
    }
}
