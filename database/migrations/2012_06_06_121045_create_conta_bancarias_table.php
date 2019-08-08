<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContaBancariasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conta_bancarias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('banco', 100);
            $table->string('agencia', 20);
            $table->enum('tipo',['poupança', 'corrente', 'fácil']);
            $table->string('nome', 100);
            $table->string('documento', 25);
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
        Schema::dropIfExists('conta_bancarias');
    }
}
