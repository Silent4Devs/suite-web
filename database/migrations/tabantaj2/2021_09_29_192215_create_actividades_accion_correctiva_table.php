<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActividadesAccionCorrectivaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividades_accion_correctiva', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('accion_correctiva_id');
            $table->string('actividad');
            $table->dateTime('fecha_inicio');
            $table->dateTime('fecha_fin');
            $table->string('prioridad');
            $table->string('tipo');
            $table->longText('comentarios');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('accion_correctiva_id')->references('id')->on('accion_correctivas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actividades_accion_correctiva');
    }
}
