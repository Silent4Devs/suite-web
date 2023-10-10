<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnResponsableToActivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activos', function (Blueprint $table) {
            $table->dropForeign('dueno_fk_2438646');
        });
        Schema::table('activos', function (Blueprint $table) {
            // $table->dropForeign('dueno_fk_2438646');
            $table->unsignedBigInteger('dueno_id')->change();
            $table->foreign('dueno_id')->references('id')->on('empleados');
            $table->string('marca')->after('descripcion')->nullable();
            $table->string('modelo')->after('marca')->nullable();
            $table->string('n_serie')->after('modelo')->nullable();
            $table->string('n_producto')->after('n_serie')->nullable();
            $table->date('fecha_fin')->after('n_producto')->nullable();
            $table->date('fecha_compra')->after('fecha_fin')->nullable();
            $table->unsignedBigInteger('id_responsable')->nullable();
            $table->foreign('id_responsable')->references('id')->on('empleados');
        });
    }

    /**
     *  Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('activos', function (Blueprint $table) {
            $table->dropforeign('activos_dueno_id_foreign');
        });

        Schema::table('activos', function (Blueprint $table) {
            // $table->dropcolumn('dueno_id');
            $table->unsignedInteger('dueno_id')->change();
            $table->foreign('dueno_id', 'dueno_fk_2438646')->references('id')->on('users');
            // $table->dropForeign('activos_id_puesto_dueno_foreign');
            // $table->dropForeign('activos_id_area_dueno_foreign');
            // $table->dropForeign('activos_id_responsable_foreign');
            // $table->dropForeign('activos_id_area_responsable_foreign');
            // $table->dropForeign('activos_id_puesto_responsable_foreign');
            // $table->dropColumn('id_puesto_dueno');
            // $table->dropColumn('id_area_dueno');
            $table->dropColumn('id_responsable');
            // $table->dropColumn('id_area_responsable');
            // $table->dropColumn('id_puesto_responsable');

            $table->dropColumn('marca');
            $table->dropColumn('modelo');
            $table->dropColumn('n_serie');
            $table->dropColumn('n_producto');
            $table->dropColumn('fecha_fin');
            $table->dropColumn('fecha_compra');
        });
    }
}
