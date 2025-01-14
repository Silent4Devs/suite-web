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
        Schema::create('firmas_ordenes_compras', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('requisicion_id');
            $table->unsignedBigInteger('comprador_id')->nullable();
            $table->longText('firma_comprador')->nullable();
            $table->date('fecha_firma_comprador_requi')->nullable();
            $table->unsignedBigInteger('solicitante_id');
            $table->longText('firma_solicitante')->nullable();
            $table->date('fecha_firma_solicitante')->nullable();
            $table->unsignedBigInteger('responsable_finanzas_id')->nullable();
            $table->longText('firma_responsable_finanzas')->nullable();
            $table->date('fecha_firma_responsable_finanzas')->nullable();

            $table->foreign('requisicion_id')->references('id')->on('requisiciones')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('comprador_id')->references('id')->on('empleados')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('solicitante_id')->references('id')->on('empleados')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('responsable_finanzas_id')->references('id')->on('empleados')->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('firmas_ordenes_compras');
    }
};
