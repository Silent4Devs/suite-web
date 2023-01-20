<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveFkEmpleadoIdToDeclaracionAplicabilidadResponsablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('declaracion_aplicabilidad_responsables', function (Blueprint $table) {
            $table->dropForeign('declaracion_aplicabilidad_responsables_empleado_id_foreign');
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
