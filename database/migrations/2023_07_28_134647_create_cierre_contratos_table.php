<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cierre_contratos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('no')->nullable();
            $table->unsignedBigInteger('contrato_id')->nullable();
            $table->foreign('contrato_id')->references('id')->on('contratos');
            $table->string('aspectos');
            $table->boolean('cumple')->nullable();
            $table->longText('observaciones')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('cierre_contratos');
    }
};
