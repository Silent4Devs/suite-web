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
        Schema::create('evaluados_evaluacion_desempenos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('evaluacion_desempeno_id');
            $table->unsignedBigInteger('evaluado_desempeno_id');
            $table->boolean('estatus_evaluado')->default(false);

            $table->foreign('evaluacion_desempeno_id')->references('id')->on('evaluacion_desempenos')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('evaluado_desempeno_id')->references('id')->on('empleados')->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluados_evaluacion_desempenos');
    }
};
