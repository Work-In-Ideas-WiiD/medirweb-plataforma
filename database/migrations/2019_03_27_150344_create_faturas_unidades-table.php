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
        Schema::create('faturas_unidades', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('FATUNI_DT', 255);
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
            $table->string('valor_total', 255);

            $table->longText('FATUNI_PRUMADAS');

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
        Schema::dropIfExists('faturas_unidades');
    }
}
