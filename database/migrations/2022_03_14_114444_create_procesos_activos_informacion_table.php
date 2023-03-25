<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcesosActivosInformacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procesos_activos_informacion', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('losprocesos_id')->nullable();
            $table->foreign('losprocesos_id')->references('id')->on('procesos')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('id_activos_informacion')->nullable();
            $table->foreign('id_activos_informacion')->references('id')->on('activos_informacion')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('procesos_activos_informacion');
    }
}
