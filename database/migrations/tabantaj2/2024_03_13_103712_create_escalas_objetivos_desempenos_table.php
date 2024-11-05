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
        Schema::create('escalas_objetivos_desempenos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_objetivo_desempeno');
            $table->integer('condicion');
            $table->float('valor');
            $table->string('parametro');
            $table->string('color');
            // $table->unsignedBigInteger('parametro_id');

            // $table->foreign('parametro_id')->references('id')->on('escalas_medicion_objetivos')->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('escalas_objetivos_desempenos');
    }
};
