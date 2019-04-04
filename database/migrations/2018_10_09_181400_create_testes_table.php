        <?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('testes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('metro');
            $table->string('litro');
            $table->string('mililitro');
            $table->string('diferenca');
            $table->string('status');
            $table->integer('valor');
            $table->string('id_imovel');
            $table->string('ip_equipamento');
            $table->string('id_hidrometro');
            $table->integer('tipo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('testes');
    }
}
