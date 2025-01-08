<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTasksColumnToJsob extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*DB::unprepared('
        ALTER TABLE public.plan_implementacions ALTER COLUMN tasks TYPE jsonb;
        ');*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plan_implementacions', function (Blueprint $table) {
            //
        });
    }
}
