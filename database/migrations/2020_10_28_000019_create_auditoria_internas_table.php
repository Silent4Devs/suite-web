<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditoriaInternasTable extends Migration
{
    public function up()
    {
        Schema::create('auditoria_internas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('alcance');
            $table->longText('hallazgos')->nullable();
            $table->boolean('cheknoconformidadmenor')->default(0)->nullable();
            $table->float('totalnoconformidadmenor')->nullable();
            $table->boolean('checknoconformidadmayor')->default(0)->nullable();
            $table->float('totalnoconformidadmayor')->nullable();
            $table->boolean('checkobservacion')->default(0)->nullable();
            $table->float('totalobservacion')->nullable();
            $table->boolean('checkmejora')->default(0)->nullable();
            $table->float('totalmejora')->nullable();
            $table->date('fechaauditoria')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
