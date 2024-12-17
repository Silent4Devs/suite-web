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
            // Eliminar los índices
            $table->dropIndex(['id']);
            $table->dropIndex(['proyecto_id']);
            $table->dropIndex(['area_id']);
            $table->dropIndex(['empleado_id']);
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
