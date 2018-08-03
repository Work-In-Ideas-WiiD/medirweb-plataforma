<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrumadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prumadas', function (Blueprint $table) {
            $table->increments('PRU_ID');
            
            $table->integer('PRU_IDUNIDADE')->unsigned();
            $table->foreign('PRU_IDUNIDADE')->references('UNI_ID')->on('unidades');

            $table->string('PRU_IDFUNCIONAL',255);
            $table->boolean('PRU_STATUS');

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
        Schema::dropIfExists('prumadas');
    }
}
