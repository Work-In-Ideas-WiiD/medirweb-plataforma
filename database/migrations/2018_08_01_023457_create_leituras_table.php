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
            $table->bigIncrements('id');
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
        DB::statement('ALTER TABLE leituras MODIFY COLUMN valor INT(6) UNSIGNED ZEROFILL NOT NULL');
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
