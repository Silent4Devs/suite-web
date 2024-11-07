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
        Schema::create('escalas_evaluacion_desempenos', function (Blueprint $table) {
            $table->id();
            $table->integer('evaluacion_desempeno_id');
            $table->string('parametro');
            $table->float('valor');
            $table->string('color');
            // $table->longText('descripcion');

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
        Schema::dropIfExists('escalas_evaluacion_desempenos');
    }
};
