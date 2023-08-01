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
        Schema::create('entregas_mensuales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('no')->nullable();
            $table->unsignedBigInteger('contrato_id')->nullable();
            $table->foreign('contrato_id')->references('id')->on('contratos');
            $table->longText('nombre_entregable')->nullable();
            $table->longText('descripcion')->nullable();
            $table->date('plazo_entrega_inicio')->nullable();
            $table->date('plazo_entrega_termina')->nullable();
            $table->date('entrega_real')->nullable();
            $table->boolean('cumplimiento')->nullable();
            $table->longText('observaciones')->nullable();
            $table->boolean('aplica_deductiva')->after('observaciones')->nullable();
            $table->string('deductiva_penalizacion')->nullable();
            $table->string('justificacion_deductiva_penalizacion')->after('deductiva_penalizacion')->nullable();
            $table->unsignedBigInteger('factura_id')->nullable();
            $table->foreign('factura_id')->references('id')->on('facturacion')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('deductiva_factura_id')->nullable();
            $table->foreign('deductiva_factura_id')->references('id')->on('facturacion')->onUpdate('cascade')->onDelete('cascade');
            $table->string('nota_credito')->nullable();
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
        Schema::dropIfExists('entregas_mensuales');
    }
};
