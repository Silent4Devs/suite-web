<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToPlanImplementacion9001Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plan_implementacion_9001', function (Blueprint $table) {
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
        Schema::table('plan_implementacion_9001', function (Blueprint $table) {
            //
        });
    }
}
