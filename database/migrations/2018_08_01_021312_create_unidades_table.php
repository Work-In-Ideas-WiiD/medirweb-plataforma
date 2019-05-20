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
            $table->foreign('UNI_IDAGRUPAMENTO')->references('AGR_ID')->on('agrupamentos')->onDelete('cascade');

            $table->integer('UNI_IDIMOVEL')->unsigned();
            $table->foreign('UNI_IDIMOVEL')->references('IMO_ID')->on('imoveis')->onDelete('cascade');

            $table->string('UNI_NOME', 200);
            $table->string('UNI_RESPONSAVEL', 200);
            $table->string('UNI_CPFRESPONSAVEL', 200);
            $table->string('UNI_TELRESPONSAVEL', 200);

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
