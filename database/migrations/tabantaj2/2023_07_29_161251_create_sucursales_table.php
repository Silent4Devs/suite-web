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
        Schema::create('sucursales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('clave')->nullable();
            $table->string('descripcion')->nullable();
            $table->string('empresa')->nullable();
            $table->string('cuenta_contable')->nullable();
            $table->string('estado')->nullable();
            $table->string('zona')->nullable();
            $table->boolean('archivo')->default(false);
            $table->string('direccion')->nullable();
            $table->string('rfc')->nullable();
            $table->string('mylogo')->nullable();
            //foreign
            $table->unsignedBigInteger('centro_costos_id')->nullable();
            $table->foreign('centro_costos_id')->references('id')->on('contratos');
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
        Schema::dropIfExists('sucursales');
    }
};
