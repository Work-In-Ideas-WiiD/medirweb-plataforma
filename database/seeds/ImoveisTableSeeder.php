<?php

use Illuminate\Database\Seeder;
use App\Models\Imovel;

use Carbon\Carbon;

class ImoveisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('imoveis')->delete();

        Imovel::create([
                'IMO_ID'                    => 1,
                'IMO_NOME'                  => 'Condomínio Residencial Maranata',
                'IMO_ENDERECO'              => 'Quadra 122 LT-14',
                'IMO_COMPLEMENTO'           => '',
                'IMO_NUMERO'                => '',
                'IMO_BAIRRO'                => 'Asa Sul',
                'IMO_IDCIDADE'              => 1,
                'IMO_IDESTADO'              => 9,
                'IMO_CEP'                   => '74000-000',
                'IMO_RESPONSAVEIS'          => 'Eduardo Hudson Josué (Síndico)<br/>Maria Jordana Gomes (Sub-síndico)<br/>Tulio Cairo Pereira (Zelador)',
                'IMO_TELEFONES'             => '(61) 98999-0055 (Eduardo)<br/>(61) 98866-4411 (Tulio)<br/>(61) 4555-0078 (Tulio)',
                'created_at' => Carbon::now()->format('Y-m-d H:i'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i')
        ]);

        Imovel::create([
                'IMO_ID'                    => 2,
                'IMO_NOME'                  => 'Edifício Leo Lince',
                'IMO_ENDERECO'              => 'Rua 450',
                'IMO_COMPLEMENTO'           => '',
                'IMO_NUMERO'                => '788',
                'IMO_BAIRRO'                => 'Setor Universitário',
                'IMO_IDCIDADE'              => 1,
                'IMO_IDESTADO'              => 9,
                'IMO_CEP'                   => '74000-000',
                'IMO_RESPONSAVEIS'          => 'Hudson Josué (Síndico)<br/>Jordana Gomes (Sub-síndico)<br/>Cairo Pereira (Zelador)',
                'IMO_TELEFONES'             => '(61) 98999-0055 (Hudson)<br/>(61) 98866-4411 (Jordana)<br/>(61) 4555-0078 (Cairo)',
                'created_at' => Carbon::now()->format('Y-m-d H:i'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i')
        ]);

        Imovel::create([
                'IMO_ID'                    => 3,
                'IMO_NOME'                  => 'Alphaville',
                'IMO_ENDERECO'              => 'BR 156',
                'IMO_COMPLEMENTO'           => 'Km 45',
                'IMO_NUMERO'                => 'S/N',
                'IMO_BAIRRO'                => 'Alphaville',
                'IMO_IDCIDADE'              => 1,
                'IMO_IDESTADO'              => 9,
                'IMO_CEP'                   => '74000-000',
                'IMO_RESPONSAVEIS'          => 'Josué (Síndico)<br/>Gomes (Sub-síndico)<br/>Pereira (Zelador)',
                'IMO_TELEFONES'             => '(61) 98999-0055 (Josué)<br/>(61) 98866-4411 (Gomes)<br/>(61) 4555-0078 (Pereira)',
                'created_at' => Carbon::now()->format('Y-m-d H:i'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i')
        ]);

        
    }
}
