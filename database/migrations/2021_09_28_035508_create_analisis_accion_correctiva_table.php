<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnalisisAccionCorrectivaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analisis_accion_correctiva', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('accion_correctiva_id')->nullable();
            $table->string('metodo')->nullable();
            $table->longText('ideas')->nullable();
            $table->longText('causa_ideas')->nullable();
            $table->longText('problema_porque')->nullable();
            $table->string('porque_1')->nullable();
            $table->string('porque_2')->nullable();
            $table->string('porque_3')->nullable();
            $table->string('porque_4')->nullable();
            $table->string('porque_5')->nullable();
            $table->longText('causa_porque')->nullable();
            $table->longText('control_a')->nullable();
            $table->longText('control_b')->nullable();
            $table->longText('proceso_a')->nullable();
            $table->longText('proceso_b')->nullable();
            $table->longText('personas_a')->nullable();
            $table->longText('personas_b')->nullable();
            $table->longText('tecnologia_a')->nullable();
            $table->longText('tecnologia_b')->nullable();
            $table->longText('metodos_a')->nullable();
            $table->longText('metodos_b')->nullable();
            $table->longText('ambiente_a')->nullable();
            $table->longText('ambiente_b')->nullable();
            $table->longText('problema_diagrama')->nullable();
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
        Schema::dropIfExists('analisis_accion_correctiva');
    }
}
