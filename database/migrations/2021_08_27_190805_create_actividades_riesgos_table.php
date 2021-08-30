<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActividadesRiesgosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividades_riesgos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('riesgo_id');
            $table->string('actividad');
            $table->dateTime('fecha_inicio');
            $table->dateTime('fecha_fin');
            $table->string('prioridad');
            $table->string('tipo');
            $table->longText('comentarios');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('riesgo_id')->references('id')->on('riesgos_identificados');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actividades_riesgos');
    }
}
