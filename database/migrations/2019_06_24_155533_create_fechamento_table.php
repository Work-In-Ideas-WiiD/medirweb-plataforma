<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFechamentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fechamentos', function (Blueprint $table) {
            $table->increments('FEC_ID');

            $table->integer('FEC_IDPRUMADA')->unsigned();
            $table->foreign('FEC_IDPRUMADA')->references('PRU_ID')->on('prumadas')->onDelete('cascade');

            $table->string('FEC_METRO')->nullable();
            $table->string('FEC_LITRO')->nullable();
            $table->string('FEC_MILILITRO')->nullable();
            $table->string('FEC_DIFERENCA')->nullable();

            $table->integer('FEC_VALOR')->nullable();
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
        Schema::dropIfExists('fechamentos');
    }
}
