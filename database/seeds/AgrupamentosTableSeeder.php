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
                'imovel_id' => 1,
                'nome' => 'Torre 1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'imovel_id' => 1,
                'nome' => 'Torre 2',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'imovel_id' => 1,
                'nome' => 'Torre 3',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'imovel_id' => 1,
                'nome' => 'Torre 4',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'imovel_id' => 1,
                'nome' => 'Torre 5',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'imovel_id' => 1,
                'nome' => 'Torre 6',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'imovel_id' => 1,
                'nome' => 'Torre 7',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'imovel_id' => 1,
                'nome' => 'Torre 8',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'imovel_id' => 1,
                'nome' => 'Torre 9',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'imovel_id' => 1,
                'nome' => 'Torre 10',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'imovel_id' => 1,
                'nome' => 'Torre 11',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'imovel_id' => 1,
                'nome' => 'Torre 12',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
        
    }
}
