<?php

use Illuminate\Database\Seeder;
use App\Models\Leitura;

use Carbon\Carbon;

class LeiturasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        DB::table('leituras')->delete();

        Leitura::create([
                'LEI_ID'                    => 1,
                'LEI_IDPRUMADA'             => 1,
                'LEI_VALOR'                 => 0,
                'created_at'                => Carbon::now()->format('Y-m-d H:i'),
                'updated_at'                => Carbon::now()->format('Y-m-d H:i')
        ]);

        Leitura::create([
                'LEI_ID'                    => 2,
                'LEI_IDPRUMADA'             => 1,
                'LEI_VALOR'                 => 25,
                'created_at'                => Carbon::now()->format('Y-m-d H:i'),
                'updated_at'                => Carbon::now()->format('Y-m-d H:i')
        ]);

        Leitura::create([
                'LEI_ID'                    => 3,
                'LEI_IDPRUMADA'             => 1,
                'LEI_VALOR'                 => 125,
                'created_at'                => Carbon::now()->format('Y-m-d H:i'),
                'updated_at'                => Carbon::now()->format('Y-m-d H:i')
        ]);

        Leitura::create([
                'LEI_ID'                    => 4,
                'LEI_IDPRUMADA'             => 1,
                'LEI_VALOR'                 => 420,
                'created_at'                => Carbon::now()->format('Y-m-d H:i'),
                'updated_at'                => Carbon::now()->format('Y-m-d H:i')
        ]);

        Leitura::create([
                'LEI_ID'                    => 5,
                'LEI_IDPRUMADA'             => 1,
                'LEI_VALOR'                 => 1121,
                'created_at'                => Carbon::now()->format('Y-m-d H:i'),
                'updated_at'                => Carbon::now()->format('Y-m-d H:i')
        ]);

        Leitura::create([
                'LEI_ID'                    => 6,
                'LEI_IDPRUMADA'             => 2,
                'LEI_VALOR'                 => 0,
                'created_at'                => Carbon::now()->format('Y-m-d H:i'),
                'updated_at'                => Carbon::now()->format('Y-m-d H:i')
        ]);

        Leitura::create([
                'LEI_ID'                    => 7,
                'LEI_IDPRUMADA'             => 2,
                'LEI_VALOR'                 => 101,
                'created_at'                => Carbon::now()->format('Y-m-d H:i'),
                'updated_at'                => Carbon::now()->format('Y-m-d H:i')
        ]);

        Leitura::create([
                'LEI_ID'                    => 8,
                'LEI_IDPRUMADA'             => 2,
                'LEI_VALOR'                 => 122,
                'created_at'                => Carbon::now()->format('Y-m-d H:i'),
                'updated_at'                => Carbon::now()->format('Y-m-d H:i')
        ]);

        Leitura::create([
                'LEI_ID'                    => 9,
                'LEI_IDPRUMADA'             => 2,
                'LEI_VALOR'                 => 305,
                'created_at'                => Carbon::now()->format('Y-m-d H:i'),
                'updated_at'                => Carbon::now()->format('Y-m-d H:i')
        ]);

        Leitura::create([
                'LEI_ID'                    => 10,
                'LEI_IDPRUMADA'             => 2,
                'LEI_VALOR'                 => 937,
                'created_at'                => Carbon::now()->format('Y-m-d H:i'),
                'updated_at'                => Carbon::now()->format('Y-m-d H:i')
        ]);

        Leitura::create([
                'LEI_ID'                    => 11,
                'LEI_IDPRUMADA'             => 3,
                'LEI_VALOR'                 => 0,
                'created_at'                => Carbon::now()->format('Y-m-d H:i'),
                'updated_at'                => Carbon::now()->format('Y-m-d H:i')
        ]);

        Leitura::create([
                'LEI_ID'                    => 12,
                'LEI_IDPRUMADA'             => 3,
                'LEI_VALOR'                 => 90,
                'created_at'                => Carbon::now()->format('Y-m-d H:i'),
                'updated_at'                => Carbon::now()->format('Y-m-d H:i')
        ]);

        Leitura::create([
                'LEI_ID'                    => 13,
                'LEI_IDPRUMADA'             => 3,
                'LEI_VALOR'                 => 210,
                'created_at'                => Carbon::now()->format('Y-m-d H:i'),
                'updated_at'                => Carbon::now()->format('Y-m-d H:i')
        ]);

        Leitura::create([
                'LEI_ID'                    => 14,
                'LEI_IDPRUMADA'             => 3,
                'LEI_VALOR'                 => 342,
                'created_at'                => Carbon::now()->format('Y-m-d H:i'),
                'updated_at'                => Carbon::now()->format('Y-m-d H:i')
        ]);

        Leitura::create([
                'LEI_ID'                    => 15,
                'LEI_IDPRUMADA'             => 3,
                'LEI_VALOR'                 => 411,
                'created_at'                => Carbon::now()->format('Y-m-d H:i'),
                'updated_at'                => Carbon::now()->format('Y-m-d H:i')
        ]);

        Leitura::create([
                'LEI_ID'                    => 16,
                'LEI_IDPRUMADA'             => 4,
                'LEI_VALOR'                 => 0,
                'created_at'                => Carbon::now()->format('Y-m-d H:i'),
                'updated_at'                => Carbon::now()->format('Y-m-d H:i')
        ]);

        Leitura::create([
                'LEI_ID'                    => 17,
                'LEI_IDPRUMADA'             => 4,
                'LEI_VALOR'                 => 77,
                'created_at'                => Carbon::now()->format('Y-m-d H:i'),
                'updated_at'                => Carbon::now()->format('Y-m-d H:i')
        ]);

        Leitura::create([
                'LEI_ID'                    => 18,
                'LEI_IDPRUMADA'             => 4,
                'LEI_VALOR'                 => 1478,
                'created_at'                => Carbon::now()->format('Y-m-d H:i'),
                'updated_at'                => Carbon::now()->format('Y-m-d H:i')
        ]);

        Leitura::create([
                'LEI_ID'                    => 19,
                'LEI_IDPRUMADA'             => 4,
                'LEI_VALOR'                 => 1982,
                'created_at'                => Carbon::now()->format('Y-m-d H:i'),
                'updated_at'                => Carbon::now()->format('Y-m-d H:i')
        ]);

        Leitura::create([
                'LEI_ID'                    => 20,
                'LEI_IDPRUMADA'             => 4,
                'LEI_VALOR'                 => 2125,
                'created_at'                => Carbon::now()->format('Y-m-d H:i'),
                'updated_at'                => Carbon::now()->format('Y-m-d H:i')
        ]);

        Leitura::create([
                'LEI_ID'                    => 21,
                'LEI_IDPRUMADA'             => 5,
                'LEI_VALOR'                 => 0,
                'created_at'                => Carbon::now()->format('Y-m-d H:i'),
                'updated_at'                => Carbon::now()->format('Y-m-d H:i')
        ]);

        Leitura::create([
                'LEI_ID'                    => 22,
                'LEI_IDPRUMADA'             => 5,
                'LEI_VALOR'                 => 11,
                'created_at'                => Carbon::now()->format('Y-m-d H:i'),
                'updated_at'                => Carbon::now()->format('Y-m-d H:i')
        ]);

        Leitura::create([
                'LEI_ID'                    => 23,
                'LEI_IDPRUMADA'             => 5,
                'LEI_VALOR'                 => 22,
                'created_at'                => Carbon::now()->format('Y-m-d H:i'),
                'updated_at'                => Carbon::now()->format('Y-m-d H:i')
        ]);

        Leitura::create([
                'LEI_ID'                    => 24,
                'LEI_IDPRUMADA'             => 5,
                'LEI_VALOR'                 => 33,
                'created_at'                => Carbon::now()->format('Y-m-d H:i'),
                'updated_at'                => Carbon::now()->format('Y-m-d H:i')
        ]);

        Leitura::create([
                'LEI_ID'                    => 25,
                'LEI_IDPRUMADA'             => 5,
                'LEI_VALOR'                 => 44,
                'created_at'                => Carbon::now()->format('Y-m-d H:i'),
                'updated_at'                => Carbon::now()->format('Y-m-d H:i')
        ]);

    }
}
