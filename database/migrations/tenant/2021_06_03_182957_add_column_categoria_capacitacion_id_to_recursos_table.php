<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnCategoriaCapacitacionIdToRecursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('recursos', function (Blueprint $table) {
            $table->unsignedBigInteger('categoria_capacitacion_id')->after('tipo')->nullable();
            $table->foreign('categoria_capacitacion_id')->references('id')->on('categoria_capacitacions')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recursos', function (Blueprint $table) {
            $table->dropForeign('recursos_categoria_capacitacion_id_foreign');
            $table->dropColumn('categoria_capacitacion_id');
        });
    }
}
