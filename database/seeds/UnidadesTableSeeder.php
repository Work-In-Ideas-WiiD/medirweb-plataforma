<?php

use Illuminate\Database\Seeder;
use App\Models\Unidade;

use Carbon\Carbon;

class UnidadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('unidades')->delete();

        Unidade::create([

            'UNI_ID'                    => 1,

            'UNI_IDAGRUPAMENTO'         => 1,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '101',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 2,

            'UNI_IDAGRUPAMENTO'         => 1,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '102',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 3,

            'UNI_IDAGRUPAMENTO'         => 1,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '103',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 4,

            'UNI_IDAGRUPAMENTO'         => 1,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '104',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 5,

            'UNI_IDAGRUPAMENTO'         => 1,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '105',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 6,

            'UNI_IDAGRUPAMENTO'         => 1,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '106',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 7,

            'UNI_IDAGRUPAMENTO'         => 1,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '107',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 8,

            'UNI_IDAGRUPAMENTO'         => 1,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '108',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 9,

            'UNI_IDAGRUPAMENTO'         => 1,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '109',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 10,

            'UNI_IDAGRUPAMENTO'         => 1,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '110',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 11,

            'UNI_IDAGRUPAMENTO'         => 1,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '111',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 12,

            'UNI_IDAGRUPAMENTO'         => 1,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '112',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 13,

            'UNI_IDAGRUPAMENTO'         => 2,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '201',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 14,

            'UNI_IDAGRUPAMENTO'         => 2,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '202',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 15,

            'UNI_IDAGRUPAMENTO'         => 2,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '203',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 16,

            'UNI_IDAGRUPAMENTO'         => 2,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '204',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 17,

            'UNI_IDAGRUPAMENTO'         => 2,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '205',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 18,

            'UNI_IDAGRUPAMENTO'         => 2,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '206',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 19,

            'UNI_IDAGRUPAMENTO'         => 2,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '207',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 20,

            'UNI_IDAGRUPAMENTO'         => 2,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '208',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 21,

            'UNI_IDAGRUPAMENTO'         => 2,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '209',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 22,

            'UNI_IDAGRUPAMENTO'         => 2,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '210',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 23,

            'UNI_IDAGRUPAMENTO'         => 2,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '211',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 24,

            'UNI_IDAGRUPAMENTO'         => 2,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '212',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 25,

            'UNI_IDAGRUPAMENTO'         => 3,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '301',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 26,

            'UNI_IDAGRUPAMENTO'         => 3,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '302',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 27,

            'UNI_IDAGRUPAMENTO'         => 3,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '303',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 28,

            'UNI_IDAGRUPAMENTO'         => 3,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '304',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 29,

            'UNI_IDAGRUPAMENTO'         => 3,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '305',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 30,

            'UNI_IDAGRUPAMENTO'         => 3,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '306',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 31,

            'UNI_IDAGRUPAMENTO'         => 3,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '307',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 32,

            'UNI_IDAGRUPAMENTO'         => 3,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '308',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 33,

            'UNI_IDAGRUPAMENTO'         => 3,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '309',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 34,

            'UNI_IDAGRUPAMENTO'         => 3,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '310',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 35,

            'UNI_IDAGRUPAMENTO'         => 3,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '311',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 36,

            'UNI_IDAGRUPAMENTO'         => 3,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '312',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 37,

            'UNI_IDAGRUPAMENTO'         => 4,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '401',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 38,

            'UNI_IDAGRUPAMENTO'         => 4,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '402',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 39,

            'UNI_IDAGRUPAMENTO'         => 4,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '403',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 40,

            'UNI_IDAGRUPAMENTO'         => 4,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '404',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 41,

            'UNI_IDAGRUPAMENTO'         => 4,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '405',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 42,

            'UNI_IDAGRUPAMENTO'         => 4,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '406',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 43,

            'UNI_IDAGRUPAMENTO'         => 4,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '407',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 44,

            'UNI_IDAGRUPAMENTO'         => 4,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '408',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 45,

            'UNI_IDAGRUPAMENTO'         => 4,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '409',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 46,

            'UNI_IDAGRUPAMENTO'         => 4,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '410',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 47,

            'UNI_IDAGRUPAMENTO'         => 4,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '411',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 48,

            'UNI_IDAGRUPAMENTO'         => 4,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '412',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 49,

            'UNI_IDAGRUPAMENTO'         => 5,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '501',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 50,

            'UNI_IDAGRUPAMENTO'         => 5,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '502',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 51,

            'UNI_IDAGRUPAMENTO'         => 5,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '503',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 52,

            'UNI_IDAGRUPAMENTO'         => 5,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '504',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 53,

            'UNI_IDAGRUPAMENTO'         => 5,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '505',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 54,

            'UNI_IDAGRUPAMENTO'         => 5,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '506',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 55,

            'UNI_IDAGRUPAMENTO'         => 5,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '507',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 56,

            'UNI_IDAGRUPAMENTO'         => 5,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '508',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 57,

            'UNI_IDAGRUPAMENTO'         => 5,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '509',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 58,

            'UNI_IDAGRUPAMENTO'         => 5,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '510',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 59,

            'UNI_IDAGRUPAMENTO'         => 5,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '511',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 60,

            'UNI_IDAGRUPAMENTO'         => 5,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '512',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 61,

            'UNI_IDAGRUPAMENTO'         => 6,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '601',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 62,

            'UNI_IDAGRUPAMENTO'         => 6,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '602',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 63,

            'UNI_IDAGRUPAMENTO'         => 6,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '603',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 64,

            'UNI_IDAGRUPAMENTO'         => 6,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '604',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 65,

            'UNI_IDAGRUPAMENTO'         => 6,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '605',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 66,

            'UNI_IDAGRUPAMENTO'         => 6,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '606',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 67,

            'UNI_IDAGRUPAMENTO'         => 6,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '607',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 68,

            'UNI_IDAGRUPAMENTO'         => 6,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '608',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 69,

            'UNI_IDAGRUPAMENTO'         => 6,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '609',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 70,

            'UNI_IDAGRUPAMENTO'         => 6,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '610',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 71,

            'UNI_IDAGRUPAMENTO'         => 6,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '611',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 72,

            'UNI_IDAGRUPAMENTO'         => 6,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '612',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 73,

            'UNI_IDAGRUPAMENTO'         => 7,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '701',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 74,

            'UNI_IDAGRUPAMENTO'         => 7,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '702',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 75,

            'UNI_IDAGRUPAMENTO'         => 7,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '703',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 76,

            'UNI_IDAGRUPAMENTO'         => 7,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '704',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 77,

            'UNI_IDAGRUPAMENTO'         => 7,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '705',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 78,

            'UNI_IDAGRUPAMENTO'         => 7,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '706',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 79,

            'UNI_IDAGRUPAMENTO'         => 7,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '707',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 80,

            'UNI_IDAGRUPAMENTO'         => 7,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '708',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 81,

            'UNI_IDAGRUPAMENTO'         => 7,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '709',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 82,

            'UNI_IDAGRUPAMENTO'         => 7,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '710',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 83,

            'UNI_IDAGRUPAMENTO'         => 7,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '711',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 84,

            'UNI_IDAGRUPAMENTO'         => 7,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '712',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 85,

            'UNI_IDAGRUPAMENTO'         => 8,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '801',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 86,

            'UNI_IDAGRUPAMENTO'         => 8,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '802',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 87,

            'UNI_IDAGRUPAMENTO'         => 8,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '803',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 88,

            'UNI_IDAGRUPAMENTO'         => 8,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '804',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 89,

            'UNI_IDAGRUPAMENTO'         => 8,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '805',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 90,

            'UNI_IDAGRUPAMENTO'         => 8,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '806',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 91,

            'UNI_IDAGRUPAMENTO'         => 8,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '807',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 92,

            'UNI_IDAGRUPAMENTO'         => 8,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '808',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 93,

            'UNI_IDAGRUPAMENTO'         => 8,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '809',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 94,

            'UNI_IDAGRUPAMENTO'         => 8,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '810',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 95,

            'UNI_IDAGRUPAMENTO'         => 8,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '811',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 96,

            'UNI_IDAGRUPAMENTO'         => 8,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '812',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 97,

            'UNI_IDAGRUPAMENTO'         => 9,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '901',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 98,

            'UNI_IDAGRUPAMENTO'         => 9,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '902',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 99,

            'UNI_IDAGRUPAMENTO'         => 9,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '903',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 100,

            'UNI_IDAGRUPAMENTO'         => 9,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '904',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 101,

            'UNI_IDAGRUPAMENTO'         => 9,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '905',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 102,

            'UNI_IDAGRUPAMENTO'         => 9,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '906',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 103,

            'UNI_IDAGRUPAMENTO'         => 9,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '907',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 104,

            'UNI_IDAGRUPAMENTO'         => 9,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '908',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 105,

            'UNI_IDAGRUPAMENTO'         => 9,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '909',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 106,

            'UNI_IDAGRUPAMENTO'         => 9,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '910',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 107,

            'UNI_IDAGRUPAMENTO'         => 9,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '911',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 108,

            'UNI_IDAGRUPAMENTO'         => 9,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '912',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 109,

            'UNI_IDAGRUPAMENTO'         => 10,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '1001',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 110,

            'UNI_IDAGRUPAMENTO'         => 10,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '1002',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 111,

            'UNI_IDAGRUPAMENTO'         => 10,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '1003',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 112,

            'UNI_IDAGRUPAMENTO'         => 10,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '1004',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 113,

            'UNI_IDAGRUPAMENTO'         => 10,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '1005',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 114,

            'UNI_IDAGRUPAMENTO'         => 10,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '1006',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 115,

            'UNI_IDAGRUPAMENTO'         => 10,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '1007',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 116,

            'UNI_IDAGRUPAMENTO'         => 10,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '1008',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 117,

            'UNI_IDAGRUPAMENTO'         => 10,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '1009',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 118,

            'UNI_IDAGRUPAMENTO'         => 10,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '1010',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 119,

            'UNI_IDAGRUPAMENTO'         => 10,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '1011',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 120,

            'UNI_IDAGRUPAMENTO'         => 10,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '1012',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 121,

            'UNI_IDAGRUPAMENTO'         => 11,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '1101',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 122,

            'UNI_IDAGRUPAMENTO'         => 11,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '1102',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 123,

            'UNI_IDAGRUPAMENTO'         => 11,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '1103',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 124,

            'UNI_IDAGRUPAMENTO'         => 11,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '1104',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 125,

            'UNI_IDAGRUPAMENTO'         => 11,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '1105',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 126,

            'UNI_IDAGRUPAMENTO'         => 11,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '1106',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 127,

            'UNI_IDAGRUPAMENTO'         => 11,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '1107',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 128,

            'UNI_IDAGRUPAMENTO'         => 11,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '1108',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 129,

            'UNI_IDAGRUPAMENTO'         => 11,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '1109',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 130,

            'UNI_IDAGRUPAMENTO'         => 11,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '1110',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 131,

            'UNI_IDAGRUPAMENTO'         => 11,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '1111',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 132,

            'UNI_IDAGRUPAMENTO'         => 11,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '1112',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 133,

            'UNI_IDAGRUPAMENTO'         => 12,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '1201',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 134,

            'UNI_IDAGRUPAMENTO'         => 12,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '1202',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 135,

            'UNI_IDAGRUPAMENTO'         => 12,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '1203',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 136,

            'UNI_IDAGRUPAMENTO'         => 12,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '1204',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 137,

            'UNI_IDAGRUPAMENTO'         => 12,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '1205',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 138,

            'UNI_IDAGRUPAMENTO'         => 12,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '1206',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 139,

            'UNI_IDAGRUPAMENTO'         => 12,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '1207',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 140,

            'UNI_IDAGRUPAMENTO'         => 12,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '1208',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 141,

            'UNI_IDAGRUPAMENTO'         => 12,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '1209',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 142,

            'UNI_IDAGRUPAMENTO'         => 12,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '1210',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 143,

            'UNI_IDAGRUPAMENTO'         => 12,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '1211',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);


        Unidade::create([

            'UNI_ID'                    => 144,

            'UNI_IDAGRUPAMENTO'         => 12,

            'UNI_IDIMOVEL'              => 1,

            'UNI_NOME'                  => '1212',

            'UNI_RESPONSAVEL'           => 'Wesley Batista',

            'UNI_CPFRESPONSAVEL'        => '111.111.111-44',

            'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',

            'created_at'                => Carbon::now()->format('Y-m-d H:i'),

            'updated_at'                => Carbon::now()->format('Y-m-d H:i')

        ]);



    }
}
