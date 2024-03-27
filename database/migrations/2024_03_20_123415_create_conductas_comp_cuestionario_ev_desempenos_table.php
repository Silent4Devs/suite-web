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
            $table->unsignedBigInteger('pregunta_cuest_comp_ev_des_id');
            $table->longText('definicion');
            $table->integer('ponderacion');

            $table->foreign('pregunta_cuest_comp_ev_des_id')->references('id')->on('cuestionario_competencia_ev_desempenos')->onUpdate('cascade')->onDelete('cascade');

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
