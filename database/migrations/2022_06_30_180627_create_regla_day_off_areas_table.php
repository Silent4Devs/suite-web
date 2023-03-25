<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReglaDayOffAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regla_dayOff_areas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('regla_id')->nullable();
            $table->unsignedBigInteger('area_id')->nullable();
            $table->foreign('regla_id')->references('id')->on('day_off')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('area_id')->references('id')->on('areas')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('regla_dayOff_areas');
    }
}
