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
        Schema::table('historico_empleados', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable(); // Agregar columna para el ID del usuario
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Agregar clave foránea para el ID del usuario
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
