<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnidadeTelefonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unidade_telefones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('unidade_id');
            $table->foreign('unidade_id')
                ->references('id')
                ->on('unidades')
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
        Schema::dropIfExists('unidade_telefones');
    }
}
