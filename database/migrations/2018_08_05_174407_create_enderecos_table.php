<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnderecosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enderecos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome', 200);
            $table->string('logradouro', 300);
            $table->string('complemento', 300);
            $table->string('numero', 300);
            $table->string('bairro', 300);
            $table->unsignedInteger('cidade_id');
            $table->foreign('cidade_id')
                ->references('id')
                ->on('cidades')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->string('cep', 20);
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
        Schema::dropIfExists('enderecos');
    }
}
