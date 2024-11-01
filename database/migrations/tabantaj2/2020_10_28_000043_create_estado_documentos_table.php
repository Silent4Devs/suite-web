<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstadoDocumentosTable extends Migration
{
    public function up()
    {
        Schema::create('estado_documentos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('estado')->nullable();
            $table->longText('descripcion')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
