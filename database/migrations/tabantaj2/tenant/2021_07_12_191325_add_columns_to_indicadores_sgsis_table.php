<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToIndicadoresSgsisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('indicadores_sgsis', function (Blueprint $table) {
            $table->dropColumn('control');
            $table->dropColumn('titulo');
            $table->dropColumn('semaforo');
            $table->dropColumn('enero');
            $table->dropColumn('febrero');
            $table->dropColumn('marzo');
            $table->dropColumn('abril');
            $table->dropColumn('mayo');
            $table->dropColumn('junio');
            $table->dropColumn('julio');
            $table->dropColumn('agosto');
            $table->dropColumn('septiembre');
            $table->dropColumn('octubre');
            $table->dropColumn('noviembre');
            $table->dropColumn('diciembre');
            $table->dropColumn('anio');
            $table->string('nombre', 100)->after('id')->nullable();
            $table->string('descripcion', 100)->after('nombre')->nullable();
            $table->string('no_revisiones', 100)->after('meta')->nullable();
            $table->string('resultado', 100)->after('no_revisiones')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('indicadores_sgsis', function (Blueprint $table) {
            //
        });
    }
}
