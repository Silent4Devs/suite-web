<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartaAceptacionAprobacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carta_aceptacion_aprobaciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('aprobador_id');
            $table->unsignedBigInteger('carta_id');
            $table->string('autoridad');
            $table->longText('comentarios')->nullable();
            $table->string('firma')->nullable();
            $table->tinyInteger('estado')->default(0);
            $table->foreign('aprobador_id')->references('id')->on('empleados')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('carta_id')->references('id')->on('carta_aceptacion')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('carta_aceptacion_aprobaciones');
    }
}
