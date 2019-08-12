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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('cliente_id');
            $table->foreign('cliente_id')
                ->references('id')
                ->on('clientes')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedBigInteger('endereco_id')->nullable();
            $table->foreign('endereco_id')
                ->references('id')
                ->on('enderecos')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('foto', 200)->nullable();
            $table->string('capa', 200)->nullable();
            $table->string('cnpj', 50);
            $table->string('nome', 200);
            $table->boolean('status')->nullable();
            $table->integer('fatura_ciclo')->nullable();
            $table->float('taxa_fixa')->nullable();
            $table->float('taxa_variavel')->nullable();
            $table->string('ip', 60)->nullable();
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
        Schema::dropIfExists('imoveis');
    }
}
