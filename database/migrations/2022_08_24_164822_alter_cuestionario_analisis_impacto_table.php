<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCuestionarioAnalisisImpactoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cuestionario_analisis_impacto', function (Blueprint $table) {
            $table->string('firma_Entrevistado')->nullable();
            $table->string('firma_Jefe')->nullable();
            $table->string('firma_Entrevistador')->nullable();
            $table->boolean('exite_firma_Entrevistado')->nullable();
            $table->boolean('exite_firma_Jefe')->nullable();
            $table->boolean('exite_firma_Entrevistador')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cuestionario_analisis_impacto', function (Blueprint $table) {
            //
        });
    }
}
