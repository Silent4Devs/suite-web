<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanAuditoriumUserPivotTable extends Migration
{
    public function up()
    {
        Schema::create('plan_auditorium_user', function (Blueprint $table) {
            $table->unsignedInteger('plan_auditorium_id');
            $table->foreign('plan_auditorium_id', 'plan_auditorium_id_fk_2475243')->references('id')->on('plan_auditoria')->onDelete('cascade');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id', 'user_id_fk_2475243')->references('id')->on('users')->onDelete('cascade');
        });
    }
}
