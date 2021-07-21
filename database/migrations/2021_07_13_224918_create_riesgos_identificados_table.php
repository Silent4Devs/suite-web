<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiesgosIdentificadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riesgos_identificados', function (Blueprint $table) {
            $table->id();
            $table->date('fecha')->nullable();
            $table->string('proceso')->nullable();
            $table->string('descripcion')->nullable();

            $table->unsignedBigInteger('empleado_reporto_id')->nullable();

            $table->foreign('empleado_reporto_id')->references('id')->on('empleados');

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
        Schema::dropIfExists('riesgos_identificados');
    }
}
