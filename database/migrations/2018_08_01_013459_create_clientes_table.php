<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('CLI_ID');

            $table->integer('CLI_TIPO')->unsigned();

            $table->string('CLI_FOTO', 200)->nullable();

            $table->string('CLI_DOCUMENTO', 200);
            $table->string('CLI_NOMEJUR', 200);
            $table->string('CLI_NOMEFAN', 200);

            $table->date('CLI_DATANASC');

            $table->boolean('CLI_STATUS');

            $table->string('CLI_LOGRADOURO', 300);
            $table->string('CLI_COMPLEMENTO', 300);
            $table->string('CLI_BAIRRO', 300);

            $table->integer('CLI_CIDADE')->unsigned();
            $table->foreign('CLI_CIDADE')->references('CID_ID')->on('cidades');

            $table->integer('CLI_ESTADO')->unsigned();
            $table->foreign('CLI_ESTADO')->references('EST_ID')->on('estados');

            $table->string('CLI_CEP', 200);

            $table->longText('CLI_DADOSBANCARIOS');
            $table->longText('CLI_DADOSCONTATO');

            $table->string('CLI_NUMERO', 200);

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
        Schema::dropIfExists('clientes');
    }
}
