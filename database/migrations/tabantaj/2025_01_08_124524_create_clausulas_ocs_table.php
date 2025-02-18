<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clausulas_oc', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('organizacion_id')->nullable(); // Clave foránea hacia 'organizacions'
            $table->unsignedBigInteger('sucursal_id')->nullable();     // Clave foránea hacia 'sucursales'
            $table->text('descripcion')->nullable();
            $table->timestamps();

            // Definir la clave foránea hacia 'organizacions'
            $table->foreign('organizacion_id')
                ->references('id')
                ->on('organizacions')
                ->onDelete('cascade');

            // Definir la clave foránea hacia 'sucursales'
            $table->foreign('sucursal_id')
                ->references('id')
                ->on('sucursales')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clausulas_oc');
    }
};
