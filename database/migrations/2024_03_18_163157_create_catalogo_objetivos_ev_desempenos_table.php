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
        Schema::create('catalogo_objetivos_ev_desempenos', function (Blueprint $table) {
            $table->id();
            $table->text('objetivo');
            $table->longText('descripcion_objetivo')->nullable();
            $table->text('KPI');
            $table->text('tipo_objetivo');
            $table->string('unidad_objetivo');
            $table->double('valor_maximo_unidad_objetivo');
            $table->double('valor_minimo_unidad_objetivo');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catalogo_objetivos_ev_desempenos');
    }
};
