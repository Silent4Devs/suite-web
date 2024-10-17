<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivosInformacion2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activos_informacion', function (Blueprint $table) {
            $table->increments('id');
            $table->string('identificador')->unique();
            $table->string('nombreVP')->nullable();
            $table->unsignedBigInteger('duenoVP')->nullable();
            $table->string('nombre_direccion')->nullable();
            $table->unsignedBigInteger('custodioALDirector')->nullable();
            $table->string('activo_informacion')->nullable();
            $table->string('formato')->nullable();
            $table->unsignedInteger('proceso_id')->nullable();
            $table->unsignedInteger('creacion')->nullable();
            $table->unsignedInteger('recepcion')->nullable();
            $table->string('otra_recepcion');
            $table->unsignedInteger('uso_digital')->nullable();
            $table->string('nombre_aplicacion')->nullable();
            $table->string('carpeta_compartida')->nullable();
            $table->string('otra_AppCarpeta')->nullable();
            $table->string('uso_fisico')->nullable();
            $table->string('otro')->nullable();
            $table->string('imprime')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('duenoVP')->references('id')->on('empleados')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('custodioALDirector')->references('id')->on('empleados')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('proceso_id')->references('id')->on('procesos')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activos_informacion');
    }
}
