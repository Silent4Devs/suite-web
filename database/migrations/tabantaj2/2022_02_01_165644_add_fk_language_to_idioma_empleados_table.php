<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFkLanguageToIdiomaEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('idioma_empleados', function (Blueprint $table) {
            $table->unsignedBigInteger('id_language')->nullable();
            $table->foreign('id_language')->references('id')->on('languages')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('idioma_empleados', function (Blueprint $table) {
            //
        });
    }
}
