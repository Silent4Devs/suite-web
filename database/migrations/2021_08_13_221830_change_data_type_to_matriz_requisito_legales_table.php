<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDataTypeToMatrizRequisitoLegalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('matriz_requisito_legales', function (Blueprint $table) {
            $table->longText('requisitoacumplir')->change();
            $table->longText('alcance')->change();
            $table->longText('metodo')->change();
            $table->longText('descripcion_cumplimiento')->change();
            $table->longText('comentarios')->change();
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
