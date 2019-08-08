<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImovelTelefonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imovel_telefones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('imovel_id');
            $table->foreign('imovel_id')
                ->references('id')
                ->on('imoveis')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('etiqueta', 50);
            $table->string('numero',20);
            $table->boolean('whatsapp')->nullable();
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
        Schema::dropIfExists('imovel_telefones');
    }
}
