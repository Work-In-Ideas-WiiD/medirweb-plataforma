<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFechamentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fechamentos', function (Blueprint $table) {
            $table->BigIncrements('id');

            $table->unsignedBigInteger('prumada_id');
            $table->foreign('prumada_id')
                ->references('id')
                ->on('prumadas')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->string('metro')->nullable();
            $table->string('litro')->nullable();
            $table->string('mililitro')->nullable();
            $table->string('diferenca')->nullable();

            $table->integer('valor')->nullable();
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
        Schema::dropIfExists('fechamentos');
    }
}
