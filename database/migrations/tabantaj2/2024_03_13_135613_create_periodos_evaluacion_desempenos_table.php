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
        Schema::create('periodos_evaluacion_desempenos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('evaluacion_desempeno_id');
            $table->string('nombre_evaluacion')->nullable();
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->boolean('habilitado')->default(false);
            $table->boolean('finalizado')->default(false);

            $table->foreign('evaluacion_desempeno_id')->references('id')->on('evaluacion_desempenos')->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('periodos_evaluacion_desempenos');
    }
};
