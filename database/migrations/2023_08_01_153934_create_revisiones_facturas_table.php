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
        Schema::create('revisiones_facturas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('id_facturacion')->nullable();
            $table->integer('no_revisiones')->nullable();
            $table->boolean('cumple')->nullable();
            $table->longText('observaciones')->nullable();
            $table->enum('estatus', ['pagada', 'progreso', 'recibido']);
            $table->timestamps();
            $table->softDeletes();
            // $table->foreign('id_facturacion')->references('id')->on('facturacion')->nullable();
            $table->unsignedBigInteger('asignado_id')->nullable();
            // $table->foreign('asignado_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('revisiones_facturas');
    }
};
