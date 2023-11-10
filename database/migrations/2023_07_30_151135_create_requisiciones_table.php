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
        Schema::create('requisiciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fecha')->nullable();
            $table->string('entrega')->nullable();
            $table->boolean('estatus')->nullable();
            $table->string('referencia')->nullable();
            $table->string('descripcion')->nullable();
            $table->string('estado')->nullable();
            $table->string('direccion_envio_proveedor')->nullable();
            $table->string('credito_proveedor')->nullable();
            $table->longText('firma_solicitante')->nullable();
            $table->longText('firma_finanzas')->nullable();
            $table->longText('firma_jefe')->nullable();
            $table->longText('firma_compras')->nullable();
            $table->longText('firma_solicitante_orden')->nullable();
            $table->longText('firma_finanzas_orden')->nullable();
            $table->longText('firma_comprador_orden')->nullable();
            $table->string('fecha_firma_solicitante_requi')->nullable();
            $table->string('fecha_firma_jefe_requi')->nullable();
            $table->string('fecha_firma_finanzas_requi')->nullable();
            $table->string('fecha_firma_comprador_requi')->nullable();
            $table->string('fecha_firma_solicitante_orden')->nullable();
            $table->string('fecha_firma_finanzas_orden')->nullable();
            $table->string('fecha_firma_comprador_orden')->nullable();
            $table->string('fecha_entrega')->nullable();
            $table->text('estado_orden')->nullable();
            $table->text('estado_orden_dos')->nullable();
            $table->text('proveedor_catalogo')->nullable();
            $table->unsignedBigInteger('proveedoroc_id')->nullable();
            $table->string('pago')->nullable();
            $table->string('dias_credito')->nullable();
            $table->string('moneda')->nullable();
            $table->string('cambio')->nullable();
            $table->boolean('archivo')->default(0);
            $table->string('sub_sub_total')->nullable();
            $table->string('sub_iva')->nullable();
            $table->string('sub_iva_retenido')->nullable();
            $table->string('sub_descuento')->nullable();
            $table->string('sub_otro')->nullable();
            $table->string('sub_isr')->nullable();
            $table->string('sub_total_total')->nullable();
            $table->string('sub_total')->nullable();
            $table->string('iva')->nullable();
            $table->string('iva_retenido')->nullable();
            $table->string('isr_retenido')->nullable();
            $table->string('total')->nullable();
            $table->string('user');
            $table->unsignedBigInteger('id_user')->nullable();
            $table->string('area');
            $table->string('email')->nullable();

            //foreign
            $table->unsignedBigInteger('proveedor_id')->nullable();
            $table->foreign('proveedor_id')->references('id')->on('proveedores')->onUpdate('cascade')->onDelete('cascade');
            //foreign
            $table->unsignedBigInteger('contrato_id')->nullable();
            $table->foreign('contrato_id')->references('id')->on('contratos');
            //foreign
            $table->unsignedBigInteger('centro_costos_id')->nullable();
            $table->foreign('centro_costos_id')->references('id')->on('contratos');
            //foreign
            $table->unsignedBigInteger('comprador_id')->nullable();
            $table->foreign('comprador_id')->references('id')->on('compradores');
            //foreign
            $table->unsignedBigInteger('sucursal_id')->nullable();
            $table->foreign('sucursal_id')->references('id')->on('sucursales');
            //foreign
            $table->unsignedBigInteger('producto_id')->nullable();
            $table->foreign('producto_id')->references('id')->on('productos');
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
        Schema::dropIfExists('requisiciones');
    }
};
