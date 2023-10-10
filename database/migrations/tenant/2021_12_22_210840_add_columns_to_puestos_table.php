<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToPuestosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('puestos', function (Blueprint $table) {
            $table->unsignedBigInteger('id_reporta')->nullable();
            $table->unsignedBigInteger('id_area')->nullable();
            $table->longText('estudios')->nullable();
            $table->longText('experiencia')->nullable();
            $table->longText('conocimientos')->nullable();
            $table->longText('conocimientos_esp')->nullable();
            $table->string('sueldo')->nullable();
            $table->string('lugar_trabajo')->nullable();
            $table->string('horario')->nullable();
            $table->integer('edad')->nullable();
            $table->string('genero')->nullable();
            $table->string('estado_civil')->nullable();

            $table->foreign('id_reporta')->references('id')->on('empleados');
            $table->foreign('id_area')->references('id')->on('areas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('puestos', function (Blueprint $table) {
            //
        });
    }
}
