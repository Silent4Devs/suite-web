<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('timesheet_proyectos_empleados', function (Blueprint $table) {
            //
            $table->float('horas_asignadas', 8, 2, true)->change();
            $table->float('costo_hora', 8, 2, true)->change();
        });

        Schema::table('timesheet_proyectos_proveedores', function (Blueprint $table) {
            //
            $table->float('horas_tercero', 8, 2, true)->change();
            $table->float('costo_tercero', 8, 2, true)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('timesheet_proyectos_empleados', function (Blueprint $table) {
            //
        });
    }
};
