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

            $table->unsignedInteger('PRU_IDUNIDADE')->nullable();
            $table->foreign('PRU_IDUNIDADE')
                ->references('UNI_ID')
                ->on('unidades')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->integer('PRU_TIPO')->default(1);

            $table->string('PRU_NOME', 255)->nullable();
            $table->string('PRU_IDFUNCIONAL',255);
            $table->string('PRU_SERIAL', 300)->nullable();
            $table->string('PRU_FABRICANTE', 300)->nullable();
            $table->string('PRU_MODELO', 300)->nullable();
            $table->string('PRU_OPERADORA', 300)->nullable();

            $table->boolean('PRU_STATUS')->nullable();

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
        Schema::dropIfExists('prumadas');
    }
}
