<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificacionAprobadoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notificacion_aprobadores', function (Blueprint $table) {
            $table->increments('id');
            $table->BigInteger('declaracion_id')->nullable();
            $table->BigInteger('aprobadores_id')->nullable();
            $table->BigInteger('responsables_id')->nullable();
            $table->boolean('indicador_aprobador')->nullable();
            $table->foreign('aprobadores_id')->references('id')->on('declaracion_aplicabilidad_aprobadores')->nullable();
            $table->foreign('responsables_id')->references('id')->on('declaracion_aplicabilidad_responsables')->nullable();
            $table->foreign('declaracion_id')->references('id')->on('declaracion_aplicabilidad')->nullable();
            $table->string('correo_aprobadores')->nullable();
            $table->string('correo_responsables')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notificacion_aprobadores');
    }
}
