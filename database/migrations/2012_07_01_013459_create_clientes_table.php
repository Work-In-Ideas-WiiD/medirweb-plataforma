<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('endereco_id')->nullable();
            $table->foreign('endereco_id')
                ->references('id')
                ->on('enderecos')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedBigInteger('tipo');
            $table->string('foto', 200)->nullable();
            $table->string('documento', 50);
            $table->string('nome_juridico', 200);
            $table->string('nome_fantasia', 200);
            $table->date('data_nascimento')->nullable();
            $table->boolean('status')->nullable();
            $table->unsignedBigInteger('conta_bancaria_id');
            $table->foreign('conta_bancaria_id')
                ->references('id')
                ->on('conta_bancarias')
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
        Schema::dropIfExists('clientes');
    }
}
