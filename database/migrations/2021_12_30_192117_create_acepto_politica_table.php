<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAceptoPoliticaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acepto_politica', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger('id_politica');

            $table->boolean('acepto')->default(true);

            $table->unsignedInteger('id_empleado');

            $table->foreign('id_empleado')->references('id')->on('empleados')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('id_politica')->references('id')->on('politica_sgsis')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('acepto_politica');
    }
}
