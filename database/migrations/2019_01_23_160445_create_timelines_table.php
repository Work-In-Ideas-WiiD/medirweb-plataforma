<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimelinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timelines', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('prumada_id');
            $table->foreign('prumada_id')
                ->references('id')
                ->on('prumadas')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('user', 100);
            $table->longText('descricao');
            $table->string('icone', 50);
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
        Schema::dropIfExists('timelines');
    }
}
