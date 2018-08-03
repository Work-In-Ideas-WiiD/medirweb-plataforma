<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgrupamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agrupamentos', function (Blueprint $table) {
            $table->increments('AGR_ID');

            $table->integer('AGR_IDIMOVEL')->unsigned();
            $table->foreign('AGR_IDIMOVEL')->references('IMO_ID')->on('imoveis');

            $table->string('AGR_NOME',255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agrupamentos');
    }
}
