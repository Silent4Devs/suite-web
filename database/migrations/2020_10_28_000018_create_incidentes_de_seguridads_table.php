<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncidentesDeSeguridadsTable extends Migration
{
    public function up()
    {
        Schema::create('incidentes_de_seguridads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('folio');
            $table->longText('resumen')->nullable();
            $table->string('prioridad')->nullable();
            $table->date('fechaocurrencia')->nullable();
            $table->string('clasificacion')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
