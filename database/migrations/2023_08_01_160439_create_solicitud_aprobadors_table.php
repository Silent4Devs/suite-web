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
        Schema::create('solicitudes_aprobadores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('estatus')->nullable();
            $table->unsignedBigInteger('solicitud_id')->nullable();
            // $table->foreign('solicitud_id')->references('id')->on('solicitudes')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('usuario_id')->nullable();
            // $table->foreign('usuario_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('solicitudes_aprobadores');
    }
};
