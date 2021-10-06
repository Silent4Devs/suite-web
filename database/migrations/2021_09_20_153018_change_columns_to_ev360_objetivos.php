<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ChangeColumnsToEv360Objetivos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ev360_objetivos', function (Blueprint $table) {
            DB::statement('ALTER TABLE ev360_objetivos ALTER COLUMN 
            meta TYPE integer USING (meta::integer)');
            $table->text('descripcion_meta')->nullable();
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
            //
        });
    }
}
