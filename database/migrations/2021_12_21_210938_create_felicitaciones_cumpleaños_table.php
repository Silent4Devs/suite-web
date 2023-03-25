<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFelicitacionesCumpleañosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('felicitaciones_cumpleaños', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cumpleañero_id');
            $table->foreign('cumpleañero_id')->references('id')->on('empleados')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('felicitador_id');
            $table->foreign('felicitador_id')->references('id')->on('empleados')->onUpdate('cascade')->onDelete('cascade');
            $table->longText('comentarios')->nullable();
            $table->boolean('like')->default(false);
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
    }
}
