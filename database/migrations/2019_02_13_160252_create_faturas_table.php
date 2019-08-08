<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faturas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('imovel_id');
            $table->foreign('imovel_id')
                ->references('id')
                ->on('imoveis')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->date('data_leitura_fornecedor');
            $table->integer('metro_fornecedor');
            $table->decimal('metro_valor_fornecedor', 22,2);
            $table->integer('metro_unidade');
            $table->integer('consumo_imovel');
            $table->decimal('consumo_valor_imovel', 22,2);
            $table->integer('consumo_unidade');
            $table->decimal('consumo_valor_unidade', 22,2);
            $table->integer('consumo_fornecedor');
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
        Schema::dropIfExists('faturas');
    }
}
