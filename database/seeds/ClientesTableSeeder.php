<?php

use Illuminate\Database\Seeder;
use App\Models\Cliente;

use Carbon\Carbon;

class ClientesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clientes')->delete();

        Cliente::create([
            'CLI_ID'                    => 1,
            'CLI_TIPO'                  => 1,
            'CLI_DOCUMENTO'             => '4969821',
            'CLI_NOMEJUR'               => 'Marcela Barbosa',
            'CLI_NOMEFAN'               => '',
            'CLI_DATANASC'              => Carbon::now()->format('Y-m-d'),
            'CLI_STATUS'                => 1,
            'CLI_LOGRADOURO'            => 'Rua A',
            'CLI_COMPLEMENTO'           => 'Quadra 7',
            'CLI_BAIRRO'                => 'Setor Moura',
            'CLI_CIDADE'                => 1,
            'CLI_ESTADO'                => 1,
            'CLI_CEP'                   => '74210-180',
            'CLI_DADOSBANCARIOS'        => '',
            'CLI_DADOSCONTATO'          => '',
            'CLI_NUMERO'                => '11',
            'created_at'                => Carbon::now()->format('Y-m-d H:i'),
            'updated_at'                => Carbon::now()->format('Y-m-d H:i')
        ]);

    }
}
