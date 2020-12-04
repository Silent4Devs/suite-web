<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGapLogroDosStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gap_logro_dos_status', function (Blueprint $table) {
            $table->id();
            $table->string('estado');
            $table->longText('significado');
            $table->timestamps();
        });

        Schema::create('gap_logro_uno_status', function (Blueprint $table) {
            $table->id();
            $table->string('estado');
            $table->longText('descripcion');
            $table->timestamps();
        });

        Schema::create('gap_logro_tres_status', function (Blueprint $table) {
            $table->id();
            $table->string('estado');
            $table->longText('descripcion');
            $table->timestamps();
        });
        
    }

   
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gap_logro_dos_status');
        Schema::dropIfExists('gap_logro_uno_status');
        Schema::dropIfExists('gap_logro_tres_status');
    }
}
