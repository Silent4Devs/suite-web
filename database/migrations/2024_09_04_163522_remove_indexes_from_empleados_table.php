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
        Schema::table('empleados', function (Blueprint $table) {
            // Eliminar índices
            $table->dropIndex(['id']);
            $table->dropIndex(['name']);
            $table->dropIndex(['email']);
            $table->dropIndex(['supervisor_id']);
            $table->dropIndex(['area_id']);
            $table->dropIndex(['n_empleado']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('empleados', function (Blueprint $table) {
            //
        });
    }
};
