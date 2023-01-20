<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNormasObjetivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('normas_objetivos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('objetivo_id');
            $table->unsignedBigInteger('norma_id');
            $table->foreign('objetivo_id')->references('id')->on('objetivosseguridads')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('norma_id')->references('id')->on('normas')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('normas_objetivos');
    }
}
