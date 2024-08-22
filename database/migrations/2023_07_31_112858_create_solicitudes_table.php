<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('proveedor_id')->nullable();
            $table->unsignedBigInteger('solicitante_id')->nullable();
            $table->unsignedBigInteger('asignado_id')->nullable();
            $table->unsignedBigInteger('tipo_id')->nullable();
            $table->string('folio')->nullable();
            $table->string('nombre')->nullable();
            $table->longText('descripcion')->nullable();
            $table->date('fecha_solicitud')->nullable();
            $table->foreign('proveedor_id')->references('id')->on('proveedores');
            $table->foreign('solicitante_id')->references('id')->on('users');
            $table->foreign('asignado_id')->references('id')->on('users');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->json('informacion')->nullable();
            $table->longText('plantilla_contenido')->nullable();
            $table->unsignedBigInteger('plantilla_id')->nullable();
            $table->foreign('plantilla_id')->references('id')->on('plantillas');
            $table->string('estado')->nullable();
            $table->longText('comentarios_rechazado')->nullable();
            $table->longText('comentarios_solicitante')->nullable();
            $table->longText('comentarios_asignado')->nullable();
            $table->unsignedBigInteger('contrato_generado_id')->nullable();
            $table->foreign('contrato_generado_id')->references('id')->on('generar_contrato')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('aprobador_id')->nullable();
            $table->foreign('aprobador_id')->references('id')->on('users');
            $table->unsignedBigInteger('area_id')->nullable();
            $table->foreign('area_id')->references('id')->on('areas')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('solicitudes');
    }
};
