<?php

use Illuminate\Database\Seeder;
use App\Models\Leitura;


class LeiturasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        Leitura::insert([
            [
				'id' => 1,
                'prumada_id' => 1,
                'valor' => 0,
                'created_at' => now(),
                'updated_at' => now()
			],
			[
				'id' => 2,
                'prumada_id' => 1,
                'valor' => 25,
                'created_at' => now(),
                'updated_at' => now()
			],
			[
				'id' => 3,
                'prumada_id' => 1,
                'valor' => 125,
                'created_at' => now(),
                'updated_at' => now()
			],
			[
				'id' => 4,
                'prumada_id' => 1,
                'valor' => 420,
                'created_at' => now(),
                'updated_at' => now()
			],
			[
				'id' => 5,
                'prumada_id' => 1,
                'valor' => 1121,
                'created_at' => now(),
                'updated_at' => now()
			],
			[
				'id' => 6,
                'prumada_id' => 2,
                'valor' => 0,
                'created_at' => now(),
                'updated_at' => now()
			],
			[
				'id' => 7,
                'prumada_id' => 2,
                'valor' => 101,
                'created_at' => now(),
                'updated_at' => now()
			],
			[
				'id' => 8,
                'prumada_id' => 2,
                'valor' => 122,
                'created_at' => now(),
                'updated_at' => now()
			],
			[
				'id' => 9,
                'prumada_id' => 2,
                'valor' => 305,
                'created_at' => now(),
                'updated_at' => now()
			],
			[
				'id' => 10,
                'prumada_id' => 2,
                'valor' => 937,
                'created_at' => now(),
                'updated_at' => now()
			],
			[
				'id' => 11,
                'prumada_id' => 3,
                'valor' => 0,
                'created_at' => now(),
                'updated_at' => now()
			],
			[
				'id' => 12,
                'prumada_id' => 3,
                'valor' => 90,
                'created_at' => now(),
                'updated_at' => now()
			],
			[
				'id' => 13,
                'prumada_id' => 3,
                'valor' => 210,
                'created_at' => now(),
                'updated_at' => now()
			],
			[
				'id' => 14,
                'prumada_id' => 3,
                'valor' => 342,
                'created_at' => now(),
                'updated_at' => now()
			],
			[
				'id' => 15,
                'prumada_id' => 3,
                'valor' => 411,
                'created_at' => now(),
                'updated_at' => now()
			],
			[
				'id' => 16,
                'prumada_id' => 4,
                'valor' => 0,
                'created_at' => now(),
                'updated_at' => now()
			],
			[
				'id' => 17,
                'prumada_id' => 4,
                'valor' => 77,
                'created_at' => now(),
                'updated_at' => now()
			],
			[
				'id' => 18,
                'prumada_id' => 4,
                'valor' => 1478,
                'created_at' => now(),
                'updated_at' => now()
			],
			[
				'id' => 19,
                'prumada_id' => 4,
                'valor' => 1982,
                'created_at' => now(),
                'updated_at' => now()
			],
			[
				'id' => 20,
                'prumada_id' => 4,
                'valor' => 2125,
                'created_at' => now(),
                'updated_at' => now()
			],
			[
				'id' => 21,
                'prumada_id' => 5,
                'valor' => 0,
                'created_at' => now(),
                'updated_at' => now()
			],
			[
				'id' => 22,
                'prumada_id' => 5,
                'valor' => 11,
                'created_at' => now(),
                'updated_at' => now()
			],
			[
				'id' => 23,
                'prumada_id' => 5,
                'valor' => 22,
                'created_at' => now(),
                'updated_at' => now()
			],
			[
				'id' => 24,
                'prumada_id' => 5,
                'valor' => 33,
                'created_at' => now(),
                'updated_at' => now()
			],
			[
				'id' => 25,
                'prumada_id' => 5,
                'valor' => 44,
                'created_at' => now(),
                'updated_at' => now()
			]

        ]);

    }
}
