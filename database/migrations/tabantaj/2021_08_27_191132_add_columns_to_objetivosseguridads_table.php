<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToObjetivosseguridadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('objetivosseguridads', function (Blueprint $table) {
            $table->unsignedBigInteger('responsable_id')->nullable();
            $table->dropColumn('anio');
            $table->string('formula')->nullable();
            $table->string('verde')->nullable();
            $table->string('amarillo')->nullable();
            $table->string('rojo')->nullable();
            $table->string('unidadmedida')->nullable();
            $table->string('meta')->nullable();
            $table->string('frecuencia')->nullable();
            $table->string('revisiones')->nullable();
            $table->integer('ano')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('objetivosseguridads', function (Blueprint $table) {
            //
        });
    }
}
