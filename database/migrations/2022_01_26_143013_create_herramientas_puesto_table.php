<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHerramientasPuestoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('herramientas_puesto', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_herramienta')->nullable();
            $table->longText('descripcion_herramienta')->nullable();
            $table->unsignedInteger('puesto_id')->after('id')->nullable();
            $table->foreign('puesto_id')->references('id')->on('puestos')->onDelete('SET NULL')->onUpdate('cascade');
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
        Schema::dropIfExists('herramientas_puesto');
    }
}
