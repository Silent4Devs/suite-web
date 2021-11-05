<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVariablesObjetivosseguridadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variables_objetivosseguridad', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_objetivo')->nullable();
            $table->foreign('id_objetivo')->references('id')->on('objetivosseguridads');
            $table->string('variable')->nullable();
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
        Schema::dropIfExists('variables_objetivosseguridad');
    }
}
