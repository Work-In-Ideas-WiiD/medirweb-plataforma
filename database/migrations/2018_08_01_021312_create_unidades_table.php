<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unidades', function (Blueprint $table) {
            $table->increments('UNI_ID');
            
            $table->integer('UNI_IDAGRUPAMENTO')->unsigned();
            $table->foreign('UNI_IDAGRUPAMENTO')->references('AGR_ID')->on('agrupamentos');

            $table->integer('UNI_IDIMOVEL')->unsigned();
            $table->foreign('UNI_IDIMOVEL')->references('IMO_ID')->on('imoveis');

            $table->string('UNI_NOME',255);
            $table->string('UNI_RESPONSAVEL',255);
            $table->string('UNI_CPFRESPONSAVEL',255);
            $table->string('UNI_TELRESPONSAVEL',255);
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
        Schema::dropIfExists('unidades');
    }
}
