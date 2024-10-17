<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantesEntendimientoOrganizacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participantes_entendimiento_organizacion', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('foda_id')->nullable();
            $table->unsignedBigInteger('empleado_id');
            $table->foreign('foda_id')->references('id')->on('entendimiento_organizacions');
            $table->foreign('empleado_id')->references('id')->on('empleados');
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
        Schema::dropIfExists('participantes_entendimiento_organizacion');
    }
}
