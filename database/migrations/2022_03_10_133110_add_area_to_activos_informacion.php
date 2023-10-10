<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddAreaToActivosInformacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // $table->unsignedBigInteger('nombre_direccion')->nullable()->change();
        DB::statement('ALTER TABLE activos_informacion ALTER COLUMN nombre_direccion TYPE integer USING (nombre_direccion::integer);');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('activos_informacion', function (Blueprint $table) {
        });
    }
}
