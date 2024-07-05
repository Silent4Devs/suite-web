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
        Schema::create('conductas_comp_cuestionario_ev_desempenos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('competencia_id');
            $table->longText('definicion');
            $table->integer('ponderacion');

            $table->foreign('competencia_id')->references('id')->on('catalogo_competencias_ev_desempenos')->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conductas_comp_cuestionario_ev_desempenos');
    }
};
