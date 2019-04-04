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

            $table->string('FATUNI_DT', 255);

            $table->integer('FATUNI_IDUNI')->unsigned();
            $table->foreign('FATUNI_IDUNI')->references('UNI_ID')->on('unidades')->onDelete('cascade');

            $table->integer('FATUNI_IDFATURA')->unsigned();
            $table->foreign('FATUNI_IDFATURA')->references('FAT_ID')->on('faturas')->onDelete('cascade');

            $table->string('FATUNI_VALORTOTAL', 255);

            $table->longText('FATUNI_PRUMADAS');

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
