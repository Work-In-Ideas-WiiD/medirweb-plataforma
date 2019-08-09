<?php

use Illuminate\Database\Seeder;
use App\Models\Imovel;


class ImoveisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Imovel::insert([
			[
				'id' => 1,
				'cliente_id' => 1,
				'cnpj' => '43.047.971/0001-08',
				'nome' => 'Condomínio Residencial Maranata',
				'logradouro' => 'Quadra 122 LT-14',
				'complemento' => '',
				'numero' => '',
				'bairro' => 'Asa Sul',
				'cidade' => 1,
				'estado_id' => 9,
				'cep' => '74000-000',
				'IMO_RESPONSAVEIS' => 'Eduardo Hudson Josué (Síndico)<br/>Maria Jordana Gomes (Sub-síndico)<br/>Tulio Cairo Pereira (Zelador)',
				'IMO_TELEFONES' => '(61) 98999-0055 (Eduardo)<br/>(61) 98866-4411 (Tulio)<br/>(61) 4555-0078 (Tulio)',
				'IMO_STATUS' => 1
			],
			[
                'id' => 2,
                'cliente_id' => 1,
                'cnpj' => '40.373.748/0001-54',
                'nome' => 'Edifício Leo Lince',
                'logradouro' => 'Rua 450',
                'complemento' => '',
                'numero' => '788',
                'bairro' => 'Setor Universitário',
                'cidade' => 1,
                'estado_id' => 9,
                'cep' => '74000-000',
                'IMO_RESPONSAVEIS' => 'Hudson Josué (Síndico)<br/>Jordana Gomes (Sub-síndico)<br/>Cairo Pereira (Zelador)',
                'IMO_TELEFONES' => '(61) 98999-0055 (Hudson)<br/>(61) 98866-4411 (Jordana)<br/>(61) 4555-0078 (Cairo)',
                'IMO_STATUS' => 1
			],
			[
                'id' => 3,
                'cliente_id' => 1,
                'cnpj' => '43.077.581/0001-72',
                'nome' => 'Alphaville',
                'logradouro' => 'BR 156',
                'complemento' => 'Km 45',
                'numero' => 'S/N',
                'bairro' => 'Alphaville',
                'cidade' => 1,
                'estado_id' => 9,
                'cep' => '74000-000',
                'IMO_RESPONSAVEIS' => 'Josué (Síndico)<br/>Gomes (Sub-síndico)<br/>Pereira (Zelador)',
                'IMO_TELEFONES' => '(61) 98999-0055 (Josué)<br/>(61) 98866-4411 (Gomes)<br/>(61) 4555-0078 (Pereira)',
                'IMO_STATUS' => 1
     		]

        ]);
       
    }
}
