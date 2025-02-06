<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCriteriosAuditoriaToAuditoriaInternasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('auditoria_internas', function (Blueprint $table) {
            $table->longText('criterios_auditoria')->nullable();
            $table->string('id_auditoria')->nullable();
            $table->string('nombre_auditoria')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('auditoria_internas', function (Blueprint $table) {
            //
        });
    }
}
