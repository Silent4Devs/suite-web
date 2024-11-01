<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('timesheet_horas', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('empleado_id')->nullable();
            $table->foreign('empleado_id')->references('id')->on('empleados')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('timesheet_horas', function (Blueprint $table) {
            //
        });
    }
};
