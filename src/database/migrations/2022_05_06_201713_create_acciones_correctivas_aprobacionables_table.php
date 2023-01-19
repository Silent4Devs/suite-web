<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccionesCorrectivasAprobacionablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acciones_correctivas_aprobacionables', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('acciones_correctivas_aprobacionables_id');
            $table->string('acciones_correctivas_aprobacionables_type');
            $table->unsignedBigInteger('acciones_correctivas_id');
            $table->foreign('acciones_correctivas_id')->references('id')->on('accion_correctivas')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('acciones_correctivas_aprobacionables');
    }
}
