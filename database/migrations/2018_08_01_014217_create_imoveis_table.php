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
            $table->string('IMO_NOME',255);
            $table->string('IMO_ENDERECO',300);
            $table->string('IMO_COMPLEMENTO',300);
            $table->string('IMO_NUMERO',50);
            $table->string('IMO_BAIRRO',255);
            
            $table->integer('IMO_IDCIDADE')->unsigned();
            $table->foreign('IMO_IDCIDADE')->references('CID_ID')->on('cidades');

            $table->integer('IMO_IDESTADO')->unsigned();
            $table->foreign('IMO_IDESTADO')->references('EST_ID')->on('estados');
            
            $table->string('IMO_CEP',255);
            
            $table->longText('IMO_RESPONSAVEIS',255);
            $table->longText('IMO_TELEFONES',255);
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