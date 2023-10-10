<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeclaracionAplicabilidadAprobadoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('declaracion_aplicabilidad_aprobadores', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('declaracion_id')->nullable();
            $table->unsignedBigInteger('aprobadores_id')->nullable();
            $table->integer('estatus')->nullable();
            $table->longText('comentarios')->nullable();
            $table->date('fecha_aprobacion')->nullable();
            $table->foreign('aprobadores_id')->references('id')->on('empleados')->nullable();
            $table->foreign('declaracion_id')->references('id')->on('declaracion_aplicabilidad')->nullable();
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
        Schema::dropIfExists('declaracion_aplicabilidad_aprobadores');
    }
}
