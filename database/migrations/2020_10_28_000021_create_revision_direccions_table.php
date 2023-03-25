<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRevisionDireccionsTable extends Migration
{
    public function up()
    {
        Schema::create('revision_direccions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('estadorevisionesprevias')->nullable();
            $table->string('cambiosinternosexternos')->nullable();
            $table->string('retroalimentaciondesempeno')->nullable();
            $table->string('retroalimentacionpartesinteresadas')->nullable();
            $table->string('resultadosriesgos')->nullable();
            $table->string('oportunidadesmejoracontinua')->nullable();
            $table->longText('acuerdoscambios')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
