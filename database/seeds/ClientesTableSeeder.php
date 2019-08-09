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

        Cliente::create([
            'id' => 1,
            'tipo' => 1,
            'documento' => '4969821',
            'nome_juridico' => 'Marcela Barbosa',
            'nome_fantasia' => '',
            'status' => 1            
        ])->endereco()->create([
            'logradouro' => 'Rua A',
            'complemento' => 'Quadra 7',
            'bairro' => 'Setor Moura',
            'cidade_id' => 1,
            'cep' => '74210-180',
            'numero' => '11'
        ]);

    }
}
