FAT_LEIMETRO<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faturas', function (Blueprint $table) {
            $table->increments('FAT_ID');

            $table->integer('FAT_IMOID')->unsigned();
            $table->foreign('FAT_IMOID')->references('IMO_ID')->on('imoveis');

            $table->date('FAT_DTLEIFORNECEDOR');

            $table->string('FAT_LEIMETRO_FORNECEDOR', 255);
            $table->string('FAT_LEIMETRO_VALORFORNECEDOR', 255);
            $table->string('FAT_LEIMETRO_UNI', 255);

            $table->string('FAT_CONSUMO_IMOVEL', 255);
            $table->string('FAT_CONSUMO_VALORIMOVEL', 255);
            $table->string('FAT_CONSUMO_UNI', 255);
            $table->string('FAT_CONSUMO_VALORUNI', 255);
            $table->string('FAT_CONSUMO_FORNECEDOR', 255);

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
        Schema::dropIfExists('faturas');
    }
}
