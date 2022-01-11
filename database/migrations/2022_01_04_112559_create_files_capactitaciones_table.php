<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesCapactitacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files_capacitaciones', function (Blueprint $table) {
            $table->id();
            $table->string('archivo');
            $table->unsignedInteger('recurso_id');
            $table->timestamps();

            $table->foreign('recurso_id')->references('id')->on('recursos')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files_capactitaciones');
    }
}
