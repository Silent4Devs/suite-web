<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsDiaInicioDiaFinToOrganizacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('organizacions', function (Blueprint $table) {
            $table->string('dia_inicio')->nullable();
            $table->string('dia_fin')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('organizacions', function (Blueprint $table) {
            //
        });
    }
}
