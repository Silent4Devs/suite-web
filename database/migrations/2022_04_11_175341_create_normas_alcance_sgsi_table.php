<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNormasAlcanceSgsiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('normas_alcance_sgsi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('alcance_id');
            $table->unsignedBigInteger('norma_id');
            $table->foreign('alcance_id')->references('id')->on('alcance_sgsis')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('norma_id')->references('id')->on('normas')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('normas_alcance_sgsi');
    }
}
