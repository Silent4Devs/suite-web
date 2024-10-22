<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePuestosContactosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('puestos_contactos', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion_contacto')->nullable();
            $table->unsignedInteger('id_contacto')->after('id')->nullable();
            $table->unsignedInteger('puesto_id')->after('id')->nullable();
            $table->foreign('puesto_id')->references('id')->on('puestos')->onDelete('SET NULL')->onUpdate('cascade');
            $table->foreign('id_contacto')->references('id')->on('empleados')->onDelete('SET NULL')->onUpdate('cascade');
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
        Schema::dropIfExists('puestos_contactos');
    }
}
