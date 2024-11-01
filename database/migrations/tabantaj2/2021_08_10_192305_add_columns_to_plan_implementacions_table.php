<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToPlanImplementacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plan_implementacions', function (Blueprint $table) {
            $table->string('norma')->after('slug')->nullable();
            $table->string('modulo_origen')->after('norma')->nullable();
            //$table->string('tipo');
            $table->longText('objetivo')->after('modulo_origen')->nullable();
            $table->unsignedBigInteger('elaboro_id')->after('objetivo')->nullable();
            $table->foreign('elaboro_id')->references('id')->on('empleados');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plan_implementacions', function (Blueprint $table) {
            $table->dropColumn('norma');
            $table->dropColumn('modulo_origen');
            $table->dropColumn('objetivo');
            $table->dropColumn('elaboro_id');
        });
    }
}
