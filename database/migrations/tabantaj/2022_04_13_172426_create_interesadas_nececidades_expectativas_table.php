<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInteresadasNececidadesExpectativasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interesadas_nececidades_expectativas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nececidades')->nullable();
            $table->string('expectativas')->nullable();
            $table->unsignedBigInteger('id_interesada');
            $table->foreign('id_interesada')->references('id')->on('partes_interesadas')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('interesadas_nececidades_expectativas');
    }
}
