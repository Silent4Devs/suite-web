<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnObservacionesToActivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activos', function (Blueprint $table) {
            $table->longText('observaciones')->nullable();
            $table->string('sede')->nullable();
            $table->string('documentos_relacionados')->nullable();
            $table->date('fecha_alta')->nullable();
            $table->date('fecha_baja')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('activos', function (Blueprint $table) {
            //
        });
    }
}
