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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('agrupamento_id');
            $table->foreign('agrupamento_id')
                ->references('id')
                ->on('agrupamentos')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedBigInteger('imovel_id');
            $table->foreign('imovel_id')
                ->references('id')
                ->on('imoveis')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('nome', 200)
                ->comment('nome da unidade');
            $table->string('nome_responsavel', 200);
            $table->string('cpf_responsavel', 200);
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
        Schema::dropIfExists('unidades');
    }
}
