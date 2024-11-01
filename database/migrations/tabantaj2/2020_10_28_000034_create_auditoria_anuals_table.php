<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditoriaAnualsTable extends Migration
{
    public function up()
    {
        Schema::create('auditoria_anuals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tipo');
            $table->date('fechainicio')->nullable();
            $table->float('dias')->nullable();
            $table->longText('observaciones')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
