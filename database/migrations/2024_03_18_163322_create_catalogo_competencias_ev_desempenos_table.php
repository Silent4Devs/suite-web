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
        Schema::create('catalogo_competencias_ev_desempenos', function (Blueprint $table) {
            $table->id();
            $table->text('competencia');
            $table->longText('descripcion_competencia')->nullable();
            $table->text('tipo_competencia');
            $table->text('nivel_esperado');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catalogo_competencias_ev_desempenos');
    }
};
