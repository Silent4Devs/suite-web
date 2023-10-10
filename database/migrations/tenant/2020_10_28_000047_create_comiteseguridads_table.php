<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComiteseguridadsTable extends Migration
{
    public function up()
    {
        Schema::create('comiteseguridads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombrerol');
            $table->date('fechavigor')->nullable();
            $table->longText('responsabilidades')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
