<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaturasUnidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fatura_unidades', function (Blueprint $table) {
            $table->bigIncrements('id');
            //$table->string('FATUNI_DT', 255);
            $table->unsignedBigInteger('unidade_id');
            $table->foreign('unidade_id')
                ->references('id')
                ->on('unidades')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedBigInteger('fatura_id');
            $table->foreign('fatura_id')
                ->references('id')
                ->on('faturas')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->decimal('prumada_valor', 22,2)
                ->comment('aqui fica o valor da prumada');

            $table->unsignedBigInteger('prumada_id');
            $table->foreign('prumada_id')
                ->references('id')
                ->on('prumadas')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->bigInteger('prumada_consumo');
            $table->bigInteger('prumada_leitura_anterior')->default(0);
            $table->date('prumada_data_leitura_anterior');
            $table->bigInteger('prumada_leitura_atual');
            $table->date('prumada_data_leitura_atual');

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
        Schema::dropIfExists('fatura_unidades');
    }
}
