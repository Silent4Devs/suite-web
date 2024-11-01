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
        Schema::table('timesheet', function (Blueprint $table) {
            // Eliminar los índices
            $table->dropIndex(['id']);
            $table->dropIndex(['empleado_id']);
            $table->dropIndex(['aprobador_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('timesheet', function (Blueprint $table) {
            //
        });
    }
};
