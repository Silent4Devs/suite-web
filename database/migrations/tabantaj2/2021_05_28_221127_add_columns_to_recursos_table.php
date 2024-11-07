<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToRecursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('recursos', function (Blueprint $table) {
            $table->dateTime('fecha_curso')->change();
            $table->dateTime('fecha_fin')->after('fecha_curso')->nullable();
            $table->char('duracion', 5)->after('fecha_fin')->nullable();
            $table->string('descripcion')->after('instructor')->nullable();
            $table->string('tipo', 25)->after('descripcion')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recursos', function (Blueprint $table) {
            $table->date('fecha_curso')->change();
            $table->dropColumn('fecha_fin');
            $table->dropColumn('duracion');
            $table->dropColumn('descripcion');
            $table->dropColumn('tipo');
        });
    }
}
