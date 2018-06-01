<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAclRolesPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('acl_roles_permissions');
        Schema::create('acl_roles_permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('role_id')->unsigned();
            $table->integer('permission_id')->unsigned();
            $table->index(['role_id', 'permission_id']);
            $table->foreign('role_id')->references('id')->on('acl_roles')->onDelete('cascade');
            $table->foreign('permission_id')->references('id')->on('acl_permissions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('acl_roles_permissions');
    }
}
