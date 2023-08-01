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
        Schema::create('proveedores', function (Blueprint $table) {
            $table->id();
            $table->string('razon_social')->nullable();
            $table->string('nombre_comercial')->nullable();
            $table->string('rfc')->nullable();
            $table->string('calle')->nullable();
            $table->string('colonia')->nullable();
            $table->string('ciudad')->nullable();
            $table->string('codigo_postal', 15)->nullable();
            $table->string('telefono')->nullable();
            $table->string('pagina_web')->nullable();
            $table->longText('nombre_completo')->nullable();
            $table->string('puesto')->nullable();
            $table->string('correo')->nullable();
            $table->string('celular')->nullable();
            $table->longText('objeto_descripcion')->nullable();
            $table->longText('cobertura')->nullable();
            $table->unsignedBigInteger('id_fiscale')->nullable();
            $table->foreign('id_fiscale')->references('id')->on('fiscales')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
            $table->SoftDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proveedores');
    }
};
