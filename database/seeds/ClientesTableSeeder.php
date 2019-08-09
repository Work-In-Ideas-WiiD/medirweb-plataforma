<?php

use Illuminate\Database\Seeder;
use App\Models\Cliente;


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
            'id' => 1,
            'tipo' => 1,
            'documento' => '4969821',
            'nome_juridico' => 'Marcela Barbosa',
            'nome_fantasia' => '',
            'data_nascimento' => '',
            'status' => 1,
            'logradouro' => 'Rua A',
            'complemento' => 'Quadra 7',
            'bairro' => 'Setor Moura',
            'cidade_id' => 1,
            'CLI_ESTADO' => 1,
            'CLI_CEP' => '74210-180',
            'CLI_DADOSBANCARIOS' => '',
            'CLI_DADOSCONTATO' => '',
            'CLI_NUMERO' => '11'
        ])->;

    }
}
