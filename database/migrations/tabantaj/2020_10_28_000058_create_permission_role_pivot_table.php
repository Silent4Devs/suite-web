<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionRolePivotTable extends Migration
{
    public function up()
    {
        Schema::create('permission_role', function (Blueprint $table) {
            $table->integer('role_id');
            $table->foreign('role_id', 'role_id_fk_2409324')->references('id')->on('roles')->onDelete('cascade');
            $table->integer('permission_id');
            $table->foreign('permission_id', 'permission_id_fk_2409324')->references('id')->on('permissions')->onDelete('cascade');
        });
    }
}
