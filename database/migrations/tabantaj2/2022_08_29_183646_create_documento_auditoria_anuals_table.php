<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentoAuditoriaAnualsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documento_auditoria_anuals', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_auditoria_anuals')->nullable();
            $table->string('documento');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documento_auditoria_anuals');
    }
}
