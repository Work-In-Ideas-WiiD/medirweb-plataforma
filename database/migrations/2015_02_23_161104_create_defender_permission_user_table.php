<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDefenderPermissionUserTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create(config('defender.permission_user_table', 'permission_user'), function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->index();
            $table->foreign('user_id')
                ->references('id')
                ->on(config('auth.table', 'users'))
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unsignedBigInteger(config('defender.permission_key', 'permission_id'))->index();
            $table->foreign(config('defender.permission_key', 'permission_id'))
                ->references('id')
                ->on(config('defender.permission_table', 'permissions'))
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
        Schema::table(config('defender.permission_user_table', 'permission_user'), function (Blueprint $table) {
            $table->dropForeign(config('defender.permission_user_table', 'permission_user').'_user_id_foreign');
            $table->dropForeign(config('defender.permission_user_table', 'permission_user').'_'.config('defender.permission_key', 'permission_id').'_foreign');
        });

        Schema::drop(config('defender.permission_user_table', 'permission_user'));
    }
}
