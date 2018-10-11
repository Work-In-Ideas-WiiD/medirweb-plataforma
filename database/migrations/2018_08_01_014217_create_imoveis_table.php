<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImoveisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imoveis', function(Blueprint $table) {
            $table->increments('IMO_ID');

            $table->integer('IMO_IDCLIENTE')->unsigned();
            $table->foreign('IMO_IDCLIENTE')->references('CLI_ID')->on('clientes');

            $table->string('IMO_CNPJ', 200);
            $table->string('IMO_NOME', 200);
            $table->string('IMO_LOGRADOURO', 300);
            $table->string('IMO_COMPLEMENTO', 300);
            $table->string('IMO_NUMERO', 300);
            $table->string('IMO_BAIRRO', 300);

            $table->integer('IMO_IDCIDADE')->unsigned();
            $table->foreign('IMO_IDCIDADE')->references('CID_ID')->on('cidades');

            $table->integer('IMO_IDESTADO')->unsigned();
            $table->foreign('IMO_IDESTADO')->references('EST_ID')->on('estados');

            $table->string('IMO_CEP', 200);

            $table->longText('IMO_RESPONSAVEIS');
            $table->longText('IMO_TELEFONES');

            $table->boolean('IMO_STATUS');

            $table->float('IMO_TAXAFIXA')->nullable();
            $table->float('IMO_TAXAVARIAVEL')->nullable();

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
        Schema::dropIfExists('imoveis');
    }
}