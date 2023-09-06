<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('timesheet_proyectos_empleados', function (Blueprint $table) {
            //
            $table->unsignedFloat('horas_asignadas', 8, 2)->change();
            $table->unsignedFloat('costo_hora', 8, 2)->change();
        });

        Schema::table('timesheet_proyectos_proveedores', function (Blueprint $table) {
            //
            $table->unsignedFloat('horas_tercero', 8, 2)->change();
            $table->unsignedFloat('costo_tercero', 8, 2)->change();
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
