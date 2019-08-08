<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrumadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prumadas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('unidade_id')->nullable();
            $table->foreign('unidade_id')
                ->references('id')
                ->on('unidades')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('tipo')->default(1);
            $table->string('nome', 255)->nullable();
            $table->string('funcional_id',255);
            $table->string('serial', 300)->nullable();
            $table->string('fabricante', 300)->nullable();
            $table->string('modelo', 300)->nullable();
            $table->string('operadora', 300)->nullable();
            $table->boolean('status')->nullable();
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
        Schema::dropIfExists('prumadas');
    }
}
