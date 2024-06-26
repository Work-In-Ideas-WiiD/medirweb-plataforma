<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDefenderPermissionRoleTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create(config('defender.permission_role_table', 'permission_role'), function (Blueprint $table) {
            $table->unsignedBigInteger(config('defender.permission_key', 'permission_id'))->index();
            $table->foreign(config('defender.permission_key', 'permission_id'))
                ->references('id')
                ->on(config('defender.permission_table', 'permissions'))
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unsignedBigInteger(config('defender.role_key', 'role_id'))->index();
            $table->foreign(config('defender.role_key', 'role_id'))
                ->references('id')
                ->on(config('defender.role_table', 'roles'))
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->tinyInteger('value')->default(-1);
            $table->timestampTz('expires')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table(config('defender.permission_role_table', 'permission_role'), function (Blueprint $table) {
            $table->dropForeign(config('defender.permission_role_table', 'permission_role').'_'.config('defender.permission_key', 'permission_id').'_foreign');
            $table->dropForeign(config('defender.permission_role_table', 'permission_role').'_'.config('defender.role_key', 'role_id').'_foreign');
        });

        Schema::drop(config('defender.permission_role_table', 'permission_role'));
    }
}
