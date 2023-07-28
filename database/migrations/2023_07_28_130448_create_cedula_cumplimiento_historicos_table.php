<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cedula_cumplimiento_historicos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contrato_id')->nullable();
            $table->string('elaboro')->nullable();
            $table->string('reviso')->nullable();
            $table->string('autorizo')->nullable();
            $table->string('cumple', 10)->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->unsignedBigInteger('id_cedula');
            //Foreign
            $table->foreign('contrato_id')->references('id')->on('contratos');
            $table->foreign('id_cedula')->references('id')->on('cedula_cumplimiento');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cedula_cumplimiento_historicos');
    }
};
