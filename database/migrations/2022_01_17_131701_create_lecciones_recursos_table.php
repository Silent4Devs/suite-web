<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeccionesRecursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lecciones_recursos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('url');
            $table->string('iframe');
            $table->unsignedBigInteger('seccion_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('seccion_id')->references('id')->on('secciones_recursos')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lecciones_recursos');
    }
}
