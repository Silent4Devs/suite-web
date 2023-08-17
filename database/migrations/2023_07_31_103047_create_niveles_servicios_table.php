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
        Schema::create('niveles_servicio', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('contrato_id')->nullable();
            $table->string('nombre')->nullable();
            $table->string('metrica')->nullable();
            $table->string('meta')->nullable();
            $table->string('unidad')->nullable();
            $table->longText('info_consulta')->nullable();
            $table->string('periodo_evaluacion')->nullable();
            $table->integer('revisiones')->nullable();
            $table->string('area')->nullable();
            $table->longText('descripcion')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('niveles_servicio');
    }
};
