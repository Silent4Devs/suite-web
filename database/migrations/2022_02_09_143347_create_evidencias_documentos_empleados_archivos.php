<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvidenciasDocumentosEmpleadosArchivos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evidencias_documentos_empleados_archivos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('evidencias_documentos_empleados_id');
            $table->foreign('evidencias_documentos_empleados_id')->references('id')->on('evidencias_documentos_empleados')->onDelete('cascade')->onUpdate('cascade');
            $table->string('documento');
            $table->boolean('archivado');
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
        Schema::dropIfExists('evidencias_documentos_empleados_archivos');
    }
}
