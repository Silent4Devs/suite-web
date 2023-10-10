<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInformacionDocumetadasTable extends Migration
{
    public function up()
    {
        Schema::create('informacion_documetadas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulodocumento');
            $table->string('tipodocumento')->nullable();
            $table->string('identificador')->nullable();
            $table->float('version')->nullable();
            $table->longText('contenido')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
