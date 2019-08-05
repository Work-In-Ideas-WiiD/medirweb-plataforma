<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cidades', function(Blueprint $table) {
            $table->increments('id');
            $table->string('nome',100);
            $table->unsignedInteger('estado_id');
            $table->foreign('estado_id')
                ->references('id')
                ->on('estados')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedInteger('codigo_ibge');
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
        //
        Schema::dropIfExists('cidades');
    }
}
