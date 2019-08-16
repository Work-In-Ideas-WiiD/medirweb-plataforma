<?php

use Illuminate\Database\Seeder;
use App\Models\Prumada;


class PrumadasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Prumada::insert([
			[
				'id' => 1,
				'unidade_id' => 1,
				'funcional_id' => 1452851,
				'status' => 1,
				'created_at' => now(),
				'updated_at' => now()
			],
			[
				'id' => 2,
                'unidade_id' => 2,
                'funcional_id' => 1452852,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
			],
			[
				'id' => 3,
                'unidade_id' => 3,
                'funcional_id' => 1452853,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
			],
			[
				'id' => 4,
                'unidade_id' => 4,
                'funcional_id' => 1452854,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
			],
			[
				'id' => 5,
                'unidade_id' => 5,
                'funcional_id' => 1452855,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
			]
        ]);

        
    }
}
