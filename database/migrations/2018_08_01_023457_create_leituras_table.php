    <?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeiturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leituras', function (Blueprint $table) {
            $table->increments('LEI_ID');

            $table->integer('LEI_IDPRUMADA')->unsigned();
            $table->foreign('LEI_IDPRUMADA')->references('PRU_ID')->on('prumadas');

            $table->string('LEI_METRO');
            $table->string('LEI_LITRO');
            $table->string('LEI_MILILITRO');
            $table->string('LEI_DIFERENCA');

            $table->integer('LEI_VALOR');

            $table->timestamps();
        });
        DB::statement('ALTER TABLE leituras MODIFY COLUMN LEI_VALOR INT(6) UNSIGNED ZEROFILL NOT NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leituras');
    }
}
