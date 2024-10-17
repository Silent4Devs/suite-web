<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNormasNececidadesExpectativasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('normas_nececidades_expectativas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('id_norma');
            $table->foreign('id_norma')->references('id')->on('normas')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('id_necesidad_expectativa');
            $table->foreign('id_necesidad_expectativa')->references('id')->on('interesadas_nececidades_expectativas')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('normas_nececidades_expectativas');
    }
}
