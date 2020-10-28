<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccionCorrectivasTable extends Migration
{
    public function up()
    {
        Schema::create('accion_correctivas', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecharegistro')->nullable();
            $table->longText('tema')->nullable();
            $table->string('causaorigen')->nullable();
            $table->longText('descripcion')->nullable();
            $table->string('metodo_causa')->nullable();
            $table->longText('solucion')->nullable();
            $table->longText('cierre_accion')->nullable();
            $table->string('estatus')->nullable();
            $table->date('fecha_compromiso')->nullable();
            $table->date('fecha_verificacion')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
