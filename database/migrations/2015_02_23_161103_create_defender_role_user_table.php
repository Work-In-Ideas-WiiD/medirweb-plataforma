<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDefenderRoleUserTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create(config('defender.role_user_table', 'role_user'), function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->index();
            $table->foreign('user_id')
                ->references('id')
                ->on(config('auth.table', 'users'))
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unsignedBigInteger(config('defender.role_key', 'role_id'))->index();
            $table->foreign(config('defender.role_key', 'role_id'))
                ->references('id')
                ->on(config('defender.role_table', 'roles'))
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table(config('defender.role_user_table', 'role_user'), function (Blueprint $table) {
            $table->dropForeign(config('defender.role_user_table', 'role_user').'_user_id_foreign');
            $table->dropForeign(config('defender.role_user_table', 'role_user').'_'.config('defender.role_key', 'role_id').'_foreign');
        });

        Schema::drop(config('defender.role_user_table', 'role_user'));
    }
}
