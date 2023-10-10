<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnvioDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('envio_documentos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('status')->nullable();
            $table->unsignedBigInteger('id_solicita')->nullable();
            $table->unsignedBigInteger('id_coordinador')->nullable();
            $table->unsignedBigInteger('id_mensajero')->nullable();
            $table->time('hora_recepcion_inicio')->nullable();
            $table->time('hora_recepcion_fin')->nullable();
            $table->date('fecha_solicitud')->nullable();
            $table->date('fecha_limite')->nullable();
            $table->longText('descripcion')->nullable();
            $table->string('lugar')->nullable();
            $table->string('destinatario')->nullable();
            $table->longText('notas')->nullable();
            $table->string('telefono')->nullable();
            $table->foreign('id_solicita')->references('id')->on('empleados')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('envio_documentos');
    }
}
