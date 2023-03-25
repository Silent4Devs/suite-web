<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNombredocumentoToEvidenciasSgsisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('evidencias_sgsis', function (Blueprint $table) {
            $table->string('nombredocumento')->after('objetivodocumento')->nullable();
            $table->unsignedBigInteger('responsable_evidencia_id')->after('responsable_id');
            $table->foreign('responsable_evidencia_id')->references('id')->on('empleados');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('evidencias_sgsis', function (Blueprint $table) {
            $table->dropColumn('responsable_evidencia_id');
        });
    }
}
