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
            $table->unsignedInteger('id_amenaza')->nullable();
            $table->unsignedInteger('id_area')->nullable();
            $table->unsignedInteger('id_vulnerabilidad')->nullable();
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
