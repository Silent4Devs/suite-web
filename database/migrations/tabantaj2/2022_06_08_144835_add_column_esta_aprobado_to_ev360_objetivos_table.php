<?php

use App\Models\RH\Objetivo;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnEstaAprobadoToEv360ObjetivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ev360_objetivos', function (Blueprint $table) {
            $table->enum('esta_aprobado', [Objetivo::APROBADO, Objetivo::RECHAZADO, Objetivo::SIN_DEFINIR])->default(Objetivo::APROBADO);
            $table->text('comentarios_aprobacion')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ev360_objetivos', function (Blueprint $table) {
            $table->dropColumn('esta_aprobado');
            $table->dropColumn('comentarios_aprobacion');
        });
    }
}
