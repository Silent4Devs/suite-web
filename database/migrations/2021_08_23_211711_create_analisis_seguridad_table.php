<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnalisisSeguridadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analisis_seguridad', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('seguridad_id')->nullable();
            $table->foreign('seguridad_id')->references('id')->on('incidentes_seguridad');

            $table->longText('causa')->nullable();
            

            $table->longText('problema')->nullable();

            $table->longText('ideas')->nullable();

            $table->string('porque_1')->nullable();
            $table->string('porque_2')->nullable();
            $table->string('porque_3')->nullable();
            $table->string('porque_4')->nullable();
            $table->string('porque_5')->nullable();

            $table->string('control_a')->nullable();
            $table->string('control_b')->nullable();
            $table->string('proceso_a')->nullable();
            $table->string('proceso_b')->nullable();
            $table->string('personas_a')->nullable();
            $table->string('personas_b')->nullable();
            $table->string('tecnologia_a')->nullable();
            $table->string('tecnologia_b')->nullable();
            $table->string('metodos_a')->nullable();
            $table->string('metodos_b')->nullable();
            $table->string('ambiente_a')->nullable();
            $table->string('ambiente_b')->nullable();

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
        Schema::dropIfExists('analisis_seguridad');
    }
}
