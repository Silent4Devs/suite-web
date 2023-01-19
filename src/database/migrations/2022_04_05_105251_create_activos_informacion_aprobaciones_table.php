<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivosInformacionAprobacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activos_informacion_aprobaciones', function (Blueprint $table) {
            $table->id();
            $table->boolean('aceptado')->default(false);
            $table->unsignedBigInteger('persona_califico_id');
            $table->unsignedBigInteger('activoInformacion_id');
            $table->unsignedBigInteger('carta_aceptacion_aprobacion_id');
            $table->foreign('persona_califico_id')->references('id')->on('empleados')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('activoInformacion_id')->references('id')->on('activos_informacion')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('carta_aceptacion_aprobacion_id')->references('id')->on('carta_aceptacion_aprobaciones')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('activos_informacion_aprobaciones');
    }
}
