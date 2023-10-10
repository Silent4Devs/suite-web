<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaSubcategoriaActivos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subcategoria_activos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('subcategoria');
            $table->unsignedInteger('categoria_id');
            $table->foreign('categoria_id')->references('id')->on('tipoactivos')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('tipoactivos', function (Blueprint $table) {
            $table->dropColumn(['subtipo']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subcategoria_activos');
    }
}
