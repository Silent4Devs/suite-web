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
        Schema::table('empleados_minutas_alta_direccion', function (Blueprint $table) {
            //
            $table->string('asistencia')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('empleados_minutas_alta_direccion', function (Blueprint $table) {
            //
            $table->dropColumn('asistencia');
        });
    }
};
