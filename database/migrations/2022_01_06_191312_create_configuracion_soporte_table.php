<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfiguracionSoporteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configuracion_soporte', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('rol')->nullable();
            $table->string('puesto')->nullable();
            $table->string('telefono')->nullable();
            $table->string('extension')->nullable();
            $table->string('tel_celular')->nullable();
            $table->string('correo')->nullable();
            $table->unsignedBigInteger('id_elaboro')->nullable();
            $table->foreign('id_elaboro')->references('id')->on('empleados');
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
        Schema::dropIfExists('configuracion_soporte');
    }
}
