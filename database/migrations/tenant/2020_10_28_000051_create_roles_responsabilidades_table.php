<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesResponsabilidadesTable extends Migration
{
    public function up()
    {
        Schema::create('roles_responsabilidades', function (Blueprint $table) {
            $table->increments('id');
            $table->string('responsabilidad');
            $table->string('direccionsgsi');
            $table->string('comiteseguridad')->nullable();
            $table->string('responsablesgsi')->nullable();
            $table->string('coordinadorsgsi')->nullable();
            $table->string('rol')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
