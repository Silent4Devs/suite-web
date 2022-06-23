<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExternosMinutaAltaDirecccionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('externos_minuta_alta_direcccion', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombreEXT')->nullable();
            $table->string('emailEXT')->nullable();
            $table->string('puestoEXT')->nullable();
            $table->string('empresaEXT')->nullable();
            $table->unsignedBigInteger('minuta_id')->nullable();
            $table->foreign('minuta_id')->references('id')->on('minutasaltadireccions')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('externos_minuta_alta_direcccion');
    }
}
