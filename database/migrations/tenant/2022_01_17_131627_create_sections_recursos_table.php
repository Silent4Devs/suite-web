<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionsRecursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('secciones_recursos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedInteger('recurso_id');
            $table->timestamps();
            $table->softDeletes();

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
        Schema::dropIfExists('sections_recursos');
    }
}
