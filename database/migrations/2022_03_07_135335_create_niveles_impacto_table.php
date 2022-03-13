<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNivelesImpactoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('niveles_impacto', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nivel')->nullable();
            $table->string('clasificacion')->nullable();
            $table->string('color', 10)->nullable();
            $table->foreign('tabla_impacto_id')->references('id')->on('tabla_impacto');
            $table->unsignedInteger('tabla_impacto_id')->nullable();
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
        Schema::dropIfExists('niveles_impacto');
    }
}
