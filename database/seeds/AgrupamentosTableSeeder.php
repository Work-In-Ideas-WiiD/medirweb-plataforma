<?php

use Illuminate\Database\Seeder;

use App\Models\Agrupamento;

class AgrupamentosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Agrupamento::insert([
            [
                'AGR_IDIMOVEL' => 1,
                'AGR_NOME' => 'Torre 1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'AGR_IDIMOVEL' => 1,
                'AGR_NOME' => 'Torre 2',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'AGR_IDIMOVEL' => 1,
                'AGR_NOME' => 'Torre 3',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'AGR_IDIMOVEL' => 1,
                'AGR_NOME' => 'Torre 4',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'AGR_IDIMOVEL' => 1,
                'AGR_NOME' => 'Torre 5',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'AGR_IDIMOVEL' => 1,
                'AGR_NOME' => 'Torre 6',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'AGR_IDIMOVEL' => 1,
                'AGR_NOME' => 'Torre 7',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'AGR_IDIMOVEL' => 1,
                'AGR_NOME' => 'Torre 8',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'AGR_IDIMOVEL' => 1,
                'AGR_NOME' => 'Torre 9',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'AGR_IDIMOVEL' => 1,
                'AGR_NOME' => 'Torre 10',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'AGR_IDIMOVEL' => 1,
                'AGR_NOME' => 'Torre 11',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'AGR_IDIMOVEL' => 1,
                'AGR_NOME' => 'Torre 12',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
        
    }
}
