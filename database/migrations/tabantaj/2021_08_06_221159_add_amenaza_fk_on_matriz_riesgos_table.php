<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAmenazaFkOnMatrizRiesgosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('matriz_riesgos', function (Blueprint $table) {
            $table->dropColumn('amenaza');
            $table->dropColumn('vulnerabilidad');
            $table->integer('id_amenaza')->nullable();
            $table->integer('id_area')->nullable();
            $table->integer('id_vulnerabilidad')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
