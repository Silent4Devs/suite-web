<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnAlcanceToMatrizRequisitoLegalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('matriz_requisito_legales', function (Blueprint $table) {
            $table->string('alcance')->after('requisitoacumplir')->nullable();
            $table->string('metodo')->after('fechaverificacion')->nullable();
            $table->string('comentarios')->after('id_reviso')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('matriz_requisito_legales', function (Blueprint $table) {
            //
        });
    }
}
