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
        Schema::create('convergencia_contratos_proyectos_clientes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('timesheet_cliente_id');
            $table->unsignedBigInteger('timesheet_proyecto_id');
            $table->unsignedBigInteger('contrato_id')->nullable();
            // Add additional fields as needed
            $table->timestamps();

            // Define foreign key constraints
            $table->foreign('timesheet_cliente_id')->references('id')->on('timesheet_clientes')->onDelete('cascade');
            $table->foreign('timesheet_proyecto_id')->references('id')->on('timesheet_proyectos')->onDelete('cascade');
            $table->foreign('contrato_id')->references('id')->on('contratos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('convergencia_contratos_proyectos_clientes');
    }
};
