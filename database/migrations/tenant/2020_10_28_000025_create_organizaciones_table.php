<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizacionesTable extends Migration
{
    public function up()
    {
        Schema::create('organizaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('organizacion');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
