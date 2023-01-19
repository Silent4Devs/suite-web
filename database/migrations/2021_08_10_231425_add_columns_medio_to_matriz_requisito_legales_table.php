<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsMedioToMatrizRequisitoLegalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('matriz_requisito_legales', function (Blueprint $table) {
            $table->string('medio')->after('requisitoacumplir')->nullable();
            $table->string('tipo')->after('formacumple')->nullable();
            $table->string('descripcion_cumplimiento')->nullable();
            $table->string('evidencia')->nullable();
            $table->unsignedBigInteger('id_reviso')->nullable();
            $table->foreign('id_reviso')->references('id')->on('empleados');
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
            $table->dropforeign('matriz_requisitos_legales_id_reviso_foreign');
        });

        Schema::table('matriz_requisito_legales', function (Blueprint $table) {
            $table->dropColumn('id_reviso');
            // $table->dropColumn('id_area_responsable');
            // $table->dropColumn('id_puesto_responsable');

            $table->dropColumn('medio');
            $table->dropColumn('tipo');
            $table->dropColumn('descripcion_cumplimiento');
            $table->dropColumn('evidencia');
        });
    }
}
