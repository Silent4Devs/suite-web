<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnRetroalimentaciondesempenoToRevisionDireccionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('revision_direccions', function (Blueprint $table) {
            $table->longText('retroalimentaciondesempeno')->nullable()->change();
            $table->longText('retroalimentacionpartesinteresadas')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('revision_direccions', function (Blueprint $table) {
            //
        });
    }
}
