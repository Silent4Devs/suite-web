<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFortalezasRiesgosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riesgosables', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('riesgosable_id');
            $table->string('riesgosable_type');
            $table->unsignedBigInteger('riesgos_id');
            $table->foreign('riesgos_id')->references('id')->on('matriz_riesgos')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('fortalezas_riesgos');
    }
}
