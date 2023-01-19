<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePuestoResponsabilidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('puesto_responsabilidades', function (Blueprint $table) {
            $table->id();
            $table->longText('actividad')->nullable();
            $table->string('resultado')->nullable();
            $table->string('indicador')->nullable();
            $table->string('tiempo_asignado')->nullable();
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
        Schema::dropIfExists('puesto_responsabilidades');
    }
}
