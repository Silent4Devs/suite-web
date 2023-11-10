<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rescision', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('clausula')->nullable();
            $table->string('nombre')->nullable();
            $table->string('articulos_referencia')->nullable();
            $table->string('detalle')->nullable();
            $table->string('puntos_evaluacion')->nullable();
            $table->string('cumplimiento')->nullable();
            $table->boolean('aplica')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rescision');
    }
};
