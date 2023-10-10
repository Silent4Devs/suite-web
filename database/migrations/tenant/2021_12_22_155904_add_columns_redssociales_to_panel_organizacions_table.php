<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsRedssocialesToPanelOrganizacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('panel_organizacions', function (Blueprint $table) {
            $table->boolean('linkedln')->nullable()->default(1);
            $table->boolean('facebook')->nullable()->default(1);
            $table->boolean('youtube')->nullable()->default(1);
            $table->boolean('twitter')->nullable()->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('panel_organizacions', function (Blueprint $table) {
            //
        });
    }
}
