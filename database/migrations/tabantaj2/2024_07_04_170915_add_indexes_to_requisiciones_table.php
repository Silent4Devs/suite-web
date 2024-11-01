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
        Schema::table('requisiciones', function (Blueprint $table) {
            $table->index('id');
            $table->index('proveedoroc_id');
            $table->index('id_user');
            $table->index('email');
            $table->index('proveedor_id');
            $table->index('contrato_id');
            $table->index('comprador_id');
            $table->index('sucursal_id');
            $table->index('producto_id');
            $table->index('id_finanzas');
            $table->index('id_finanzas_oc');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('requisiciones', function (Blueprint $table) {
            $table->dropIndex(['id']);
            $table->dropUnique(['proveedoroc_id']);
            $table->dropIndex(['id_user']);
            $table->dropIndex(['email']);
            $table->dropIndex(['proveedor_id']);
            $table->dropIndex(['contrato_id']);
            $table->dropIndex(['comprador_id']);
            $table->dropUnique(['sucursal_id']);
            $table->dropIndex(['producto_id']);
            $table->dropIndex(['id_finanzas']);
            $table->dropIndex(['id_finanzas_oc']);
        });
    }
};
