<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartesInteresadasClausulaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partes_interesadas_clausula', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('clausula_id');
            $table->foreign('clausula_id')->references('id')->on('clausulas')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedInteger('partesint_id');
            $table->foreign('partesint_id')->references('id')->on('partes_interesadas')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('partes_interesadas_clausula');
    }
}
