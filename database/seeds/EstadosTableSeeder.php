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
                'id' => 1,
                'nome' => 'Acre',
                'codigo' => 'AC',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 2,
                'nome' => 'Alagoas',
                'codigo' => 'AL',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 3,
                'nome' => 'Amapá',
                'codigo' => 'AP',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 4,
                'nome' => 'Amazonas',
                'codigo' => 'AM',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 5,
                'nome' => 'Bahia',
                'codigo' => 'BA',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 6,
                'nome' => 'Ceará',
                'codigo' => 'CE',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 7,
                'nome' => 'Distrito Federal',
                'codigo' => 'DF',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 8,
                'nome' => 'Espírito Santo',
                'codigo' => 'ES',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 9,
                'nome' => 'Goiás',
                'codigo' => 'GO',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 10,
                'nome' => 'Maranhão',
                'codigo' => 'MA',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 11,
                'nome' => 'Mato Grosso',
                'codigo' => 'MT',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 12,
                'nome' => 'Mato Grosso do Sul',
                'codigo' => 'MS',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 13,
                'nome' => 'Minas Gerais',
                'codigo' => 'MG',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 14,
                'nome' => 'Pará',
                'codigo' => 'PA',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 15,
                'nome' => 'Paraíba',
                'codigo' => 'PB',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 16,
                'nome' => 'Paraná',
                'codigo' => 'PR',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 17,
                'nome' => 'Pernambuco',
                'codigo' => 'PE',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 18,
                'nome' => 'Piauí',
                'codigo' => 'PI',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 19,
                'nome' => 'Rio de Janeiro',
                'codigo' => 'RJ',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 20,
                'nome' => 'Rio Grande do Norte',
                'codigo' => 'RN',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 21,
                'nome' => 'Rio Grande do Sul',
                'codigo' => 'RS',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 22,
                'nome' => 'Rondônia',
                'codigo' => 'RO',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 23,
                'nome' => 'Roraima',
                'codigo' => 'RR',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 24,
                'nome' => 'Santa Catarina',
                'codigo' => 'SC',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 25,
                'nome' => 'São Paulo',
                'codigo' => 'SP',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 26,
                'nome' => 'Sergipe',
                'codigo' => 'SE',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 27,
                'nome' => 'Tocantins',
                'codigo' => 'TO',
                'created_at' => now(),
                'updated_at' => now()
            ]

        ]);

    }
}
