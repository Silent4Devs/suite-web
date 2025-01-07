<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('timesheet_proyectos_empleados', function (Blueprint $table) {
            $table->index('id');
            $table->index('proyecto_id');
            $table->index('area_id');
            $table->index('empleado_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('timesheet_proyectos_empleados', function (Blueprint $table) {
            //
        });
    }
};
