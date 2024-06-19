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
        Schema::create('historico_empleados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('empleado_id');
            $table->string('campo_modificado');
            $table->date('fecha_cambio');
            $table->unsignedBigInteger('valor_anterior_id');
            $table->string('tabla_origen');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('empleado_id')->references('id')->on('empleados')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historico_empleados');
    }
};
