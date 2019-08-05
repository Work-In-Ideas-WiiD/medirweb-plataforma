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
            $table->BigIncrements('id');

            $table->unsignedBigInteger('tipo');

            $table->string('foto', 200)->nullable();

            $table->string('documento', 50);
            $table->string('nome_juridico', 200);
            $table->string('nome_fantasia', 200);

            $table->date('data_nascimento')->nullable();

            $table->boolean('status')->nullable();

            $table->longText('CLI_DADOSBANCARIOS');
            $table->longText('CLI_DADOSCONTATO');

            
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
