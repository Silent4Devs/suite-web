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
        Schema::create('escalas_obj_cuestionario_ev_desempenos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('objetivo_id');
            $table->integer('condicion');
            $table->text('parametro');
            $table->double('valor');
            $table->string('color');

            $table->foreign('objetivo_id')->references('id')->on('catalogo_objetivos_ev_desempenos')->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('escalas_obj_cuestionario_ev_desempenos');
    }
};
