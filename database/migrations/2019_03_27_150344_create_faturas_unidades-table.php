<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaturasUnidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faturas_unidades', function (Blueprint $table) {
            $table->increments('FATUNI_ID');

            $table->integer('FATUNI_IDUNI')->unsigned();
            $table->foreign('FATUNI_IDUNI')->references('UNI_ID')->on('unidades');

            $table->integer('FATUNI_IDFATURA')->unsigned();
            $table->foreign('FATUNI_IDFATURA')->references('FAT_ID')->on('faturas');

            $table->longText('FATUNI_PRUCONSUMO');
            $table->longText('FATUNI_PRUVALOR');

            $table->longText('FATUNI_LEIANTERIOR');
            $table->longText('FATUNI_DTLEIANTERIOR');

            $table->longText('FATUNI_LEIATUAL');
            $table->longText('FATUNI_DTLEIATUAL');

            $table->string('FATUNI_VALORTOTAL', 255);

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
        Schema::dropIfExists('faturas_unidades');
    }
}
