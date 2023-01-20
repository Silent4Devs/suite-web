<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuestionarioInfraestructuraTecnologicaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuestionario_infraestructura_tecnologica', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sistemas')->nullable();
            $table->string('aplicativos')->nullable();
            $table->string('base_datos')->nullable();
            $table->string('otro')->nullable();
            $table->integer('escenario')->nullable();
            $table->unsignedBigInteger('cuestionario_id')->nullable();
            $table->foreign('cuestionario_id')->references('id')->on('cuestionario_analisis_impacto')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('cuestionario_infraestructura_tecnologica');
    }
}
