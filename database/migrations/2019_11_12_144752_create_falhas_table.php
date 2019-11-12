<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFalhasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('falhas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('prumada_id');
            $table->foreign('prumada_id')
                ->references('id')
                ->on('prumadas')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('status', 50);
            $table->softDeletesTz();
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('falhas');
    }
}
