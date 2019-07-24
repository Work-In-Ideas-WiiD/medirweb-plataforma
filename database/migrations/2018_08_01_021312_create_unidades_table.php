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
            $table->increments('UNI_ID');

            $table->unsignedInteger('UNI_IDAGRUPAMENTO');
            $table->foreign('UNI_IDAGRUPAMENTO')
                ->references('AGR_ID')
                ->on('agrupamentos')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unsignedInteger('UNI_IDIMOVEL');
            $table->foreign('UNI_IDIMOVEL')
                ->references('IMO_ID')
                ->on('imoveis')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->string('UNI_NOME', 200);
            $table->string('UNI_RESPONSAVEL', 200);
            $table->string('UNI_CPFRESPONSAVEL', 200);
            $table->string('UNI_TELRESPONSAVEL', 200);

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
