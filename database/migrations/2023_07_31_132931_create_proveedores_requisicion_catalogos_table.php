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
        Schema::create('proveedores_requisiciones_catalogos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('requisicion_id')->nullable();
            // $table->foreign('requisicion_id')->references('id')->on('requsiciones')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('proveedor_id')->nullable();
            // $table->foreign('proveedor_id')->references('id')->on('proveedor_o_c_s')->onUpdate('cascade')->onDelete('cascade');
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
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
        Schema::dropIfExists('proveedores_requisiciones_catalogos');
    }
};
