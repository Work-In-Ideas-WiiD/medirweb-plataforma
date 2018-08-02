<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cidades', function(Blueprint $table) {
            $table->increments('CID_ID');
            $table->string('CID_NOME',255);
            $table->integer('CID_IDESTADO')->unsigned();
            $table->foreign('CID_IDESTADO')->references('EST_ID')->on('estados');
            $table->integer('CID_CODIBGE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('Cidades');
    }
}
