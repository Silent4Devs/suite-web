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
        Schema::create('aprobadores_firma_contratos_historico', function (Blueprint $table) {
            $table->id();

            $table->integer('contrato_id')->nullable();
            $table->foreign('contrato_id')->references('id')->on('contratos')->onUpdate('cascade')->onDelete('cascade');

            $table->integer('solicitante_id')->nullable();
            $table->foreign('solicitante_id')->references('id')->on('empleados')->onUpdate('cascade')->onDelete('cascade');

            $table->integer('empleado_update_id')->nullable();
            $table->foreign('empleado_update_id')->references('id')->on('empleados')->onUpdate('cascade')->onDelete('cascade');

            $table->boolean('firma_check')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aprobadores_firma_contratos_historico');
    }
};
