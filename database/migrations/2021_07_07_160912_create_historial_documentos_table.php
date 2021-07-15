<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorialDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historial_documentos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->string('nombre');
            $table->string('tipo');
            $table->unsignedInteger('macroproceso_id')->nullable();
            $table->string('estatus');
            $table->string('version');
            $table->dateTime('fecha');
            $table->string('archivo');
            $table->unsignedBigInteger('elaboro_id')->nullable();
            $table->unsignedBigInteger('reviso_id')->nullable();
            $table->unsignedBigInteger('aprobo_id')->nullable();
            $table->unsignedBigInteger('responsable_id')->nullable();
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
        Schema::dropIfExists('historial_documentos');
    }
}
