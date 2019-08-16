<?php

use Illuminate\Database\Seeder;
use App\Models\Imovel;
use App\Models\Endereco;

class ImoveisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $imovel = Endereco::create([
            'logradouro' => 'Quadra 122 LT-14',
            'complemento' => '',
            'numero' => '',
            'bairro' => 'Asa Sul',
            'cidade_id' => 1,
            'cep' => '74000-000',
        ])->imovel()->create([
            'id' => 1,
            'cliente_id' => 1,
            'cnpj' => '43.047.971/0001-08',
            'nome' => 'Condomínio Residencial Maranata',
            'status' => 1
        ]);

        $imovel->responsavel()->insert([
            [
                'imovel_id' => $imovel->id,
                'nome' => 'Eduardo Hudson Josué',
                'descricao' => 'Síndico'
            ],
            [
                'imovel_id' => $imovel->id,
                'nome' => 'Maria Jordana Gomes',
                'descricao' => 'Sub-síndico'
            ],
            [
                'imovel_id' => $imovel->id,
                'nome' => 'Tulio Cairo Pereira',
                'descricao' => 'Zelador'
            ]
        ]);

        $imovel->telefone()->insert([
            [
                'imovel_id' => $imovel->id,
                'numero' => '(61) 98999-0055',
                'etiqueta' => 'Eduardo'
            ],
            [
                'imovel_id' => $imovel->id,
                'numero' => '(61) 98866-4411',
                'etiqueta' => 'Tulio'
            ],
            [
                'imovel_id' => $imovel->id,
                'numero' => '(61) 4555-0078',
                'etiqueta' => 'Tulio'
            ]
        ]);


		$imovel = Endereco::create([
            'logradouro' => 'Rua 450',
            'complemento' => '',
            'numero' => '788',
            'bairro' => 'Setor Universitário',
            'cidade_id' => 1,
            'cep' => '74000-000'
        ])->imovel()->create([
            'id' => 2,
            'cliente_id' => 1,
            'cnpj' => '40.373.748/0001-54',
            'nome' => 'Edifício Leo Lince',
            'status' => 1
        ]);

        $imovel->responsavel()->insert([
            [
                'imovel_id' => $imovel->id,
                'nome' => 'Hudson Josué',
                'descricao' => 'Síndico'
            ],
            [
                'imovel_id' => $imovel->id,
                'nome' => 'Jordana Gomes',
                'descricao' => 'Sub-síndico'
            ],
            [
                'imovel_id' => $imovel->id,
                'nome' => 'Cairo Pereira',
                'descricao' => 'Zelador'
            ]
        ]);

        $imovel->telefone()->insert([
            [
                'imovel_id' => $imovel->id,
                'numero' => '(61) 98999-0055',
                'etiqueta' => 'Hudson'
            ],
            [
                'imovel_id' => $imovel->id,
                'numero' => '(61) 98866-4411',
                'descricao' => 'Jordana'
            ],
            [
                'imovel_id' => $imovel->id,
                'numero' => '(61) 4555-0078',
                'descricao' => 'Cairo'
            ]
        ]);
				
        
        $imovel = Endereco::create([            
            'logradouro' => 'BR 156',
            'complemento' => 'Km 45',
            'numero' => 'S/N',
            'bairro' => 'Alphaville',
            'cidade_id' => 1,
            'cep' => '74000-000',
        ])->imovel()->create([
            'id' => 3,
            'cliente_id' => 1,
            'cnpj' => '43.077.581/0001-72',
            'nome' => 'Alphaville',
            'status' => 1
        ]);

        $imovel->responsavel()->insert([
            [
                'imovel_id' => $imovel->id,
                'nome' => 'Josué',
                'descricao' => 'Síndico',
            ],
            [
                'imovel_id' => $imovel->id,
                'nome' => 'Gomes',
                'descricao' => 'Sub-síndico',
            ],
            [
                'imovel_id' => $imovel->id,
                'nome' => 'Pereira',
                'descricao' => 'Zelador'
            ]
        ]);

        $imovel->telefone()->insert([
            [
                'imovel_id' => $imovel->id,
                'numero' => '(61) 98999-0055',
                'etiqueta' => 'Josué'
            ],
            [
                'imovel_id' => $imovel->id,
                'numero' => '(61) 98866-4411',
                'etiqueta' => 'Gomes'
            ],
            [
                'imovel_id' => $imovel->id,
                'numero' => '(61) 4555-0078',
                'etiqueta' => 'Pereira'
            ]
        ]);

    }
}
