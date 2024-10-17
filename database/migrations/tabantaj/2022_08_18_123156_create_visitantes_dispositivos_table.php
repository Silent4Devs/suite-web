<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitantesDispositivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitantes_dispositivos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('registrar_visitante_id');
            $table->string('dispositivo');
            $table->string('serie');
            $table->string('marca')->nullable();
            $table->string('modelo')->nullable();
            $table->foreign('registrar_visitante_id')->references('id')->on('registrar_visitantes')->onDelete('cascade');
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
        Schema::dropIfExists('visitantes_dispositivos');
    }
}
