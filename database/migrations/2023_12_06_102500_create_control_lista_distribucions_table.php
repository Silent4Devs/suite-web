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
        Schema::create('control_lista_distribucions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proceso_id');
            $table->unsignedBigInteger('participante_id');
            $table->string('estatus');
            $table->string('firma')->nullable();
            $table->timestamps();

            $table->foreign('proceso_id')->references('id')->on('procesos_lista_distribucions')->onChange('cascade')->onDelete('cascade');
            $table->foreign('participante_id')->references('id')->on('participantes_lista_distribucions')->onChange('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('control_lista_distribucions');
    }
};
