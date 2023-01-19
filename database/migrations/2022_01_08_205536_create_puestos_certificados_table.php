<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePuestosCertificadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('puestos_certificados', function (Blueprint $table) {
            $table->id();
            $table->string('requisito')->nullable();
            $table->string('nombre')->nullable();
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
        Schema::dropIfExists('puestos_certificados');
    }
}
