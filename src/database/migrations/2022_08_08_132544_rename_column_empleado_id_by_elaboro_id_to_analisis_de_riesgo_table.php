<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameColumnEmpleadoIdByElaboroIdToAnalisisDeRiesgoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('analisis_de_riesgo', function (Blueprint $table) {
            if (Schema::hasColumn($table->getTable(), 'id_empleado')) {
                $table->renameColumn('id_empleado', 'id_elaboro');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('analisis_de_riesgo', function (Blueprint $table) {
            //
        });
    }
}
