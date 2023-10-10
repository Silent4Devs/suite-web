<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInformacionDocumetadaPoliticaSgsiPivotTable extends Migration
{
    public function up()
    {
        Schema::create('informacion_documetada_politica_sgsi', function (Blueprint $table) {
            $table->unsignedInteger('informacion_documetada_id');
            $table->foreign('informacion_documetada_id', 'informacion_documetada_id_fk_2438584')->references('id')->on('informacion_documetadas')->onDelete('cascade');
            $table->unsignedInteger('politica_sgsi_id');
            $table->foreign('politica_sgsi_id', 'politica_sgsi_id_fk_2438584')->references('id')->on('politica_sgsis')->onDelete('cascade');
        });
    }
}
