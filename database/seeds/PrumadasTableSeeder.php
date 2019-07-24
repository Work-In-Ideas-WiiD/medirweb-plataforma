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
				'PRU_ID' => 1,
				'PRU_IDUNIDADE' => 1,
				'PRU_IDFUNCIONAL' => 1452851,
				'PRU_STATUS' => 1,
				'created_at' => now(),
				'updated_at' => now()
			],
			[
				'PRU_ID' => 2,
                'PRU_IDUNIDADE' => 2,
                'PRU_IDFUNCIONAL' => 1452852,
                'PRU_STATUS' => 1,
                'created_at' => now(),
                'updated_at' => now()
			],
			[
				'PRU_ID' => 3,
                'PRU_IDUNIDADE' => 3,
                'PRU_IDFUNCIONAL' => 1452853,
                'PRU_STATUS' => 1,
                'created_at' => now(),
                'updated_at' => now()
			],
			[
				'PRU_ID' => 4,
                'PRU_IDUNIDADE' => 4,
                'PRU_IDFUNCIONAL' => 1452854,
                'PRU_STATUS' => 1,
                'created_at' => now(),
                'updated_at' => now()
			],
			[
				'PRU_ID' => 5,
                'PRU_IDUNIDADE' => 5,
                'PRU_IDFUNCIONAL' => 1452855,
                'PRU_STATUS' => 1,
                'created_at' => now(),
                'updated_at' => now()
			]
        ]);

        
    }
}
