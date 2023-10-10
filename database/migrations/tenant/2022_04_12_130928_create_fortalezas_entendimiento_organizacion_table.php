<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFortalezasEntendimientoOrganizacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fortalezas_entendimiento_organizacion', function (Blueprint $table) {
            $table->id();
            $table->string('fortaleza')->nullable();
            $table->longText('riesgo')->nullable();
            $table->unsignedBigInteger('foda_id')->nullable();
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
        Schema::dropIfExists('fortalezas_entendimiento_organizacion');
    }
}
