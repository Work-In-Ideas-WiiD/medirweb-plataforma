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
            $table->foreign('LEI_IDPRUMADA')->references('PRU_ID')->on('prumadas')->onDelete('cascade');

            $table->string('LEI_METRO')->nullable();;
            $table->string('LEI_LITRO')->nullable();;
            $table->string('LEI_MILILITRO')->nullable();;
            $table->string('LEI_DIFERENCA')->nullable();;

            $table->integer('LEI_VALOR')->nullable();;

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
