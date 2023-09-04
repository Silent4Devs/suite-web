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
        Schema::create('facturacion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('contrato_id')->nullable();
            $table->foreign('contrato_id')->references('id')->on('contratos');
            $table->string('no_factura', 50)->nullable();
            $table->longText('concepto')->nullable();
            $table->date('fecha_recepcion')->nullable();
            $table->date('fecha_liberacion')->nullable();
            $table->integer('no_revisiones')->nullable();
            $table->boolean('cumple')->nullable();
            $table->text('hallazgos_comentarios')->nullable();
            $table->decimal('monto_factura', 13, 2)->nullable();
            $table->longText('observaciones')->nullable();
            $table->boolean('conformidad')->after('observaciones')->nullable();
            $table->boolean('firma')->after('observaciones')->nullable();
            $table->string('n_cxl')->after('observaciones')->nullable();
            $table->string('estatus')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facturacion');
    }
};
