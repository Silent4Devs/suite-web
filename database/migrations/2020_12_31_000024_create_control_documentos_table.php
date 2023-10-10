<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateControlDocumentosTable extends Migration
{
    public function up()
    {
        Schema::create('control_documentos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('clave')->nullable();
            $table->string('nombre')->nullable();
            $table->date('fecha_creacion')->nullable();
            $table->string('version')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
