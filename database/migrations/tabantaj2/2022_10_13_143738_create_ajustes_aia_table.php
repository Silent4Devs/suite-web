<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAjustesAiaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ajustes_aia', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('impacto_operativo')->nullable();
            $table->integer('impacto_regulatorio')->nullable();
            $table->integer('impacto_reputacion')->nullable();
            $table->integer('impacto_social')->nullable();
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
        Schema::dropIfExists('ajustes_aia');
    }
}
