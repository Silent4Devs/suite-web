<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePuestosContactosExternosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('puestos_contactos_externos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_contacto_int')->nullable();
            $table->longText('proposito')->nullable();
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
        Schema::dropIfExists('puestos_contactos_externos');
    }
}
