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
            $table->increments('TIMELINE_ID');

            $table->integer('TIMELINE_IDPRUMADA')->unsigned();
            $table->foreign('TIMELINE_IDPRUMADA')->references('PRU_ID')->on('prumadas')->onDelete('cascade');

            $table->string('TIMELINE_USER', 100);
            $table->longText('TIMELINE_DESCRICAO');
            $table->string('TIMELINE_ICON', 50);

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
