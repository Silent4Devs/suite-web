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
        Schema::create('contratos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_contrato');
            $table->string('tipo_contrato')->nullable();
            $table->unsignedBigInteger('proveedor_id')->nullable();
            $table->string('nombre_servicio')->nullable();
            $table->longText('objetivo')->nullable();
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->string('vigencia_contrato')->nullable();
            $table->integer('no_pagos')->nullable();
            $table->string('administrador_contrato')->nullable();
            $table->string('cargo_administrador')->nullable();
            $table->string('servicios_descripcion')->nullable();
            $table->date('fecha_firma')->nullable();
            $table->string('periodo_pagos')->nullable();
            $table->decimal('monto_pago', 13, 2)->nullable();
            $table->date('fecha_inicio_pago')->nullable();
            $table->decimal('minimo', 13, 2)->nullable();
            $table->decimal('maximo', 13, 2)->nullable();
            $table->string('area')->nullable();
            $table->string('puesto')->nullable();
            $table->string('pmp_asignado')->nullable();
            $table->string('clasificacion')->nullable();
            $table->string('fase')->nullable();
            $table->string('estatus')->nullable();
            // $table->foreign('proveedor_id')->references('id')->on('proveedores');
            $table->boolean('contrato_ampliado')->after('fase')->nullable();
            $table->string('folio')->after('estatus')->nullable();
            $table->string('documento')->after('folio')->nullable();
            $table->string('file_contrato')->after('estatus')->nullable();
            $table->string('area_administrador')->after('area')->nullable();
            $table->boolean('convenio_modificatorio')->after('documento')->nullable();
            $table->string('tipo_cambio')->nullable();
            $table->string('no_proyecto')->nullable();
            $table->unsignedBigInteger('area_id')->nullable();
            $table->foreign('area_id')->references('id')->on('areas')->onUpdate('cascade')->onDelete('cascade');
            $table->boolean('identificador_privado')->nullable()->default(false);
            $table->string('firma1')->nullable();
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
        Schema::dropIfExists('contratos');
    }
};
