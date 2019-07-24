<?php

use Illuminate\Database\Seeder;
use App\Models\Estado;

class EstadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Estado::insert([
            [
                'EST_ID' => 1,
                'EST_NOME' => 'Acre',
                'EST_ABREVIACAO' => 'AC',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'EST_ID' => 2,
                'EST_NOME' => 'Alagoas',
                'EST_ABREVIACAO' => 'AL',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'EST_ID' => 3,
                'EST_NOME' => 'Amapá',
                'EST_ABREVIACAO' => 'AP',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'EST_ID' => 4,
                'EST_NOME' => 'Amazonas',
                'EST_ABREVIACAO' => 'AM',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'EST_ID' => 5,
                'EST_NOME' => 'Bahia',
                'EST_ABREVIACAO' => 'BA',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'EST_ID' => 6,
                'EST_NOME' => 'Ceará',
                'EST_ABREVIACAO' => 'CE',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'EST_ID' => 7,
                'EST_NOME' => 'Distrito Federal',
                'EST_ABREVIACAO' => 'DF',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'EST_ID' => 8,
                'EST_NOME' => 'Espírito Santo',
                'EST_ABREVIACAO' => 'ES',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'EST_ID' => 9,
                'EST_NOME' => 'Goiás',
                'EST_ABREVIACAO' => 'GO',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'EST_ID' => 10,
                'EST_NOME' => 'Maranhão',
                'EST_ABREVIACAO' => 'MA',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'EST_ID' => 11,
                'EST_NOME' => 'Mato Grosso',
                'EST_ABREVIACAO' => 'MT',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'EST_ID' => 12,
                'EST_NOME' => 'Mato Grosso do Sul',
                'EST_ABREVIACAO' => 'MS',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'EST_ID' => 13,
                'EST_NOME' => 'Minas Gerais',
                'EST_ABREVIACAO' => 'MG',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'EST_ID' => 14,
                'EST_NOME' => 'Pará',
                'EST_ABREVIACAO' => 'PA',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'EST_ID' => 15,
                'EST_NOME' => 'Paraíba',
                'EST_ABREVIACAO' => 'PB',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'EST_ID' => 16,
                'EST_NOME' => 'Paraná',
                'EST_ABREVIACAO' => 'PR',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'EST_ID' => 17,
                'EST_NOME' => 'Pernambuco',
                'EST_ABREVIACAO' => 'PE',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'EST_ID' => 18,
                'EST_NOME' => 'Piauí',
                'EST_ABREVIACAO' => 'PI',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'EST_ID' => 19,
                'EST_NOME' => 'Rio de Janeiro',
                'EST_ABREVIACAO' => 'RJ',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'EST_ID' => 20,
                'EST_NOME' => 'Rio Grande do Norte',
                'EST_ABREVIACAO' => 'RN',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'EST_ID' => 21,
                'EST_NOME' => 'Rio Grande do Sul',
                'EST_ABREVIACAO' => 'RS',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'EST_ID' => 22,
                'EST_NOME' => 'Rondônia',
                'EST_ABREVIACAO' => 'RO',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'EST_ID' => 23,
                'EST_NOME' => 'Roraima',
                'EST_ABREVIACAO' => 'RR',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'EST_ID' => 24,
                'EST_NOME' => 'Santa Catarina',
                'EST_ABREVIACAO' => 'SC',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'EST_ID' => 25,
                'EST_NOME' => 'São Paulo',
                'EST_ABREVIACAO' => 'SP',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'EST_ID' => 26,
                'EST_NOME' => 'Sergipe',
                'EST_ABREVIACAO' => 'SE',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'EST_ID' => 27,
                'EST_NOME' => 'Tocantins',
                'EST_ABREVIACAO' => 'TO',
                'created_at' => now(),
                'updated_at' => now()
            ]

        ]);

    }
}
