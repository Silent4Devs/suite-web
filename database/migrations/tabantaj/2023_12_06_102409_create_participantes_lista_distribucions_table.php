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
        Schema::create('participantes_lista_distribucions', function (Blueprint $table) {
            $table->id();
            $table->integer('modulo_id');
            $table->integer('nivel');
            $table->integer('numero_orden');
            $table->integer('empleado_id');
            $table->timestamps();

            $table->foreign('modulo_id')->references('id')->on('lista_distribucions')->onChange('cascade')->onDelete('cascade');
            $table->foreign('empleado_id')->references('id')->on('empleados');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participantes_lista_distribucions');
    }
};
