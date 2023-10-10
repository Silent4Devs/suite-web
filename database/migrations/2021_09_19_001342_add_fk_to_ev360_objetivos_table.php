<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFkToEv360ObjetivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ev360_objetivos', function (Blueprint $table) {
            $table->unsignedInteger('tipo_id');
            $table->foreign('tipo_id')->references('id')->on('ev360_tipo_objetivos')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ev360_objetivos', function (Blueprint $table) {
            //
        });
    }
}
