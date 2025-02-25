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
        Schema::create('rangos_indicadores_s_g_s_i_s', function (Blueprint $table) {
            $table->id();
            $table->float('valor_minimo');
            $table->float('valor_maximo');
            $table->string('flujo');
            $table->unsignedBigInteger('id_indicador_sgsi');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_indicador_sgsi')->references('id')->on('indicadores_sgsis')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rangos_indicadores_s_g_s_i_s');
    }
};
