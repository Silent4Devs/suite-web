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
        Schema::create('proveedor_requisicions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('proveedor')->nullable();
            $table->longText('detalles')->nullable();
            $table->longText('tipo')->nullable();
            $table->longText('comentarios')->nullable();
            $table->longText('contacto')->nullable();
            $table->integer('contacto_telefono')->nullable();
            $table->longText('contacto_correo')->nullable();
            $table->string('cel')->nullable();
            $table->longText('url')->nullable();
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->string('cotizacion')->nullable();
            //foreign
            $table->unsignedBigInteger('requisiciones_id')->nullable();
            // $table->foreign('requisiciones_id')->references('id')->on('requisiciones')->onUpdate('cascade')->onDelete('cascade');
            //foreign
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
        Schema::dropIfExists('proveedor_requisicions');
    }
};
