<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDebilidadesEntendimientoOrganizacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('debilidades_entendimiento_organizacion', function (Blueprint $table) {
            $table->id();
            $table->string('debilidad')->nullable();
            $table->longText('riesgo')->nullable();
            $table->integer('foda_id')->nullable();
            $table->foreign('foda_id')->references('id')->on('entendimiento_organizacions');
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
        Schema::dropIfExists('debilidades_entendimiento_organizacion');
    }
}
