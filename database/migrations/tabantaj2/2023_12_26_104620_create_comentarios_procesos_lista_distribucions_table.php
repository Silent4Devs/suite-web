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
        Schema::create('comentarios_procesos_lista_distribucions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proceso_id');
            $table->longText('comentario')->nullable();

            $table->foreign('proceso_id')->references('id')->on('procesos_lista_distribucions')->onChange('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comentarios_procesos_lista_distribucions');
    }
};
