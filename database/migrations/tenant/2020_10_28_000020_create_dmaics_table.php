<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDmaicsTable extends Migration
{
    public function up()
    {
        Schema::create('dmaics', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('definir')->nullable();
            $table->longText('medir')->nullable();
            $table->longText('analizar')->nullable();
            $table->longText('implementar')->nullable();
            $table->longText('controlar')->nullable();
            $table->longText('leccionesaprendidas')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
