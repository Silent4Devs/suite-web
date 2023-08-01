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
        Schema::create('orden_compras', function (Blueprint $table) {
            $table->id();
            $table->date('fecha')->nullable();
            $table->date('fecha_entrega')->nullable();
            $table->boolean('fecha_pago')->nullable();
            $table->string('moneda')->nullable();
            $table->string('tipo_cambio')->nullable();
            $table->string('referencia')->nullable();
            $table->float('credito')->nullable();
            $table->integer('dias_credito')->nullable();
            $table->float('credito_disponible')->nullable();
            $table->string('razon_social')->nullable();
            $table->string('domicilio')->nullable();
            $table->string('rfc')->nullable();
            $table->string('atencion')->nullable();
            $table->string('comentario')->nullable();

            //foreign
            $table->unsignedBigInteger('centro_costos_id')->nullable();
            $table->foreign('centro_costos_id')->references('id')->on('contratos');
            //foreign
            $table->unsignedBigInteger('requisiciones_id')->nullable();
            $table->foreign('requisiciones_id')->references('id')->on('requisiciones');
            //foreign
            $table->unsignedBigInteger('contrato_id')->nullable();
            $table->foreign('contrato_id')->references('id')->on('contratos');
            //foreign
            $table->unsignedBigInteger('proveedor_id')->nullable();
            $table->foreign('proveedor_id')->references('id')->on('proveedores');
            //foreign
            $table->unsignedBigInteger('comprador_id')->nullable();
            $table->foreign('comprador_id')->references('id')->on('compradores');
            //foreign
            $table->unsignedBigInteger('sucursal_id')->nullable();
            $table->foreign('sucursal_id')->references('id')->on('sucursales');
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
        Schema::dropIfExists('orden_compras');
    }
};
