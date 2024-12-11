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
        Schema::table('firmas_requisiciones', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('delegado_jefe_id')->nullable();
            $table->unsignedBigInteger('delegado_finanzas_id')->nullable();
            $table->unsignedBigInteger('delegado_comprador_id')->nullable();

            $table->foreign('delegado_jefe_id')->references('id')->on('empleados')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('delegado_finanzas_id')->references('id')->on('empleados')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('delegado_comprador_id')->references('id')->on('empleados')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('firmas_requisiciones', function (Blueprint $table) {
            // Eliminar las claves foráneas
            $table->dropForeign(['delegado_jefe_id']);
            $table->dropForeign(['delegado_finanzas_id']);
            $table->dropForeign(['delegado_comprador_id']);

            // Eliminar las columnas
            $table->dropColumn(['delegado_jefe_id', 'delegado_finanzas_id', 'delegado_comprador_id']);
        });
    }

};
