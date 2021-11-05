<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditoriaInternoClausulaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auditoria_interno_clausula', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('clausula_id');
            $table->foreign('clausula_id')->references('id')->on('clausulas')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedInteger('auditoria_id');
            $table->foreign('auditoria_id')->references('id')->on('auditoria_internas')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('auditoria_interno_clausula');
    }
}
