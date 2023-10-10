<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos_requisicion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('espesificaciones');
            $table->integer('cantidad');
            //foreign
            $table->unsignedBigInteger('producto_id')->nullable();
            // $table->foreign('producto_id')->references('id')->on('productos')->onUpdate('cascade')->onDelete('cascade');
            //foreign
            $table->unsignedBigInteger('requisiciones_id')->nullable();
            // $table->foreign('requisiciones_id')->references('id')->on('requsiciones')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('contrato_id')->nullable();
            // $table->foreign('contrato_id')->references('id')->on('contratos')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('no_personas')->nullable();
            $table->integer('porcentaje_involucramiento')->nullable();
            $table->unsignedInteger('centro_costo_id')->nullable();
            // $table->foreign('centro_costo_id')->references('id')->on('centro_costos')->onUpdate('cascade')->onDelete('cascade');
            $table->string('sub_total')->nullable();
            $table->string('descuento')->nullable();
            $table->string('otro_impuesto')->nullable();
            $table->string('iva')->nullable();
            $table->string('iva_retenido')->nullable();
            $table->string('isr_retenido')->nullable();
            $table->string('total')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('productos_requisicion');
    }
};
