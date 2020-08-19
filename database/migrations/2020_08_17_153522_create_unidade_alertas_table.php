<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnidadeAlertasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unidade_alertas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('device');
            $table->unsignedBigInteger('unidade_id');
            $table->foreign('unidade_id')
                ->references('id')
                ->on('unidades')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->timestampTz('visto_em')->nullable();
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
        Schema::dropIfExists('unidade_alertas');
    }
}
