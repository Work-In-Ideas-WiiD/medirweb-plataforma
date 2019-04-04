<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipamentos', function (Blueprint $table) {
            $table->increments('EQP_ID');

            $table->integer('EQP_IDUNIDADE')->unsigned();
            $table->foreign('EQP_IDUNIDADE')->references('UNI_ID')->on('unidades')->onDelete('cascade');

            $table->integer('EQP_IDFUNCIONAL')->unsigned();

            $table->string('EQP_SERIAL', 300);
            $table->string('EQP_FABRICANTE', 300);
            $table->string('EQP_MODELO', 300);
            $table->string('EQP_OPERADORA', 300);

            $table->integer('EQP_STATUS')->unsigned();

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
        Schema::dropIfExists('equipamentos');
    }
}
