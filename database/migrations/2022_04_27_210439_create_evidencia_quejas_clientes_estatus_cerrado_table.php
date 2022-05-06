<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvidenciaQuejasClientesEstatusCerradoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evidencia_quejas_clientes_estatus_cerrado', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quejas_clientes_id')->nullable();
            $table->string('cierre');
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
        Schema::dropIfExists('evidencia_quejas_clientes_estatus_cerrado');
    }
}
