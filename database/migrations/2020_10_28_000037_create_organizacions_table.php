<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizacionsTable extends Migration
{
    public function up()
    {
        Schema::create('organizacions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('empresa');
            $table->longText('direccion');
            $table->string('telefono')->nullable();
            $table->string('correo')->nullable();
            $table->string('pagina_web')->nullable();
            $table->string('giro')->nullable();
            $table->string('servicios')->nullable();
            $table->longText('mision')->nullable();
            $table->longText('vision')->nullable();
            $table->longText('valores')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }
}
