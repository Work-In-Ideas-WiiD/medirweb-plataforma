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

            $table->unsignedInteger('AGR_IDIMOVEL');
            $table->foreign('AGR_IDIMOVEL')
                ->references('IMO_ID')
                ->on('imoveis')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->string('AGR_NOME', 300)->nullable();
            $table->string('AGR_TAXAFIXA', 200)->nullable();
            $table->string('AGR_TAXAVARIAVEL', 200)->nullable();
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
        Schema::dropIfExists('agrupamentos');
    }
}
