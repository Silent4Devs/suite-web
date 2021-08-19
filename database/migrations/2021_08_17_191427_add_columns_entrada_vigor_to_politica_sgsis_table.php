<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsEntradaVigorToPoliticaSgsisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('politica_sgsis', function (Blueprint $table) {
            $table->date('fecha_publicacion')->nullable();
            $table->date('fecha_entrada')->nullable();
            $table->date('fecha_revision')->nullable();
            $table->unsignedBigInteger('id_reviso_politica')->nullable();
            $table->foreign('id_reviso_politica')->references('id')->on('empleados');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('politica_sgsis', function (Blueprint $table) {
            //
        });
    }
}
