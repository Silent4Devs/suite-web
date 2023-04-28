<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnvioDocumentosAjustesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('envio_documentos_ajustes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('id_coordinador')->nullable();
            $table->unsignedBigInteger('id_mensajero')->nullable();
            $table->foreign('id_coordinador')->references('id')->on('empleados')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_mensajero')->references('id')->on('empleados')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('envio_documentos_ajustes');
    }
}
