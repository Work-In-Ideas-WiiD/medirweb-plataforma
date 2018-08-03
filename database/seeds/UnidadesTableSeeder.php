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
                'UNI_IDAGRUPAMENTO'         => 2,
                'UNI_IDIMOVEL'              => 1,
                'UNI_NOME'                  => '101',
                'UNI_RESPONSAVEL'           => 'Wesley Batista',
                'UNI_CPFRESPONSAVEL'        => '111.111.111-44',
                'UNI_TELRESPONSAVEL'        => '(61) 2525-6868',
                'created_at' => Carbon::now()->format('Y-m-d H:i'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i')
        ]);

        Unidade::create([
                'UNI_ID'                    => 2,
                'UNI_IDAGRUPAMENTO'         => 2,
                'UNI_IDIMOVEL'              => 1,
                'UNI_NOME'                  => '102',
                'UNI_RESPONSAVEL'           => 'Jefferson Costa',
                'UNI_CPFRESPONSAVEL'        => '222.222.222-77',
                'UNI_TELRESPONSAVEL'        => '(61) 98585-7878',
                'created_at' => Carbon::now()->format('Y-m-d H:i'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i')
        ]);

        Unidade::create([
                'UNI_ID'                    => 3,
                'UNI_IDAGRUPAMENTO'         => 2,
                'UNI_IDIMOVEL'              => 1,
                'UNI_NOME'                  => '103',
                'UNI_RESPONSAVEL'           => 'Caruso Moura',
                'UNI_CPFRESPONSAVEL'        => '333.333.333-00',
                'UNI_TELRESPONSAVEL'        => '(61) 94747-2222',
                'created_at' => Carbon::now()->format('Y-m-d H:i'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i')
        ]);

        Unidade::create([
                'UNI_ID'                    => 4,
                'UNI_IDAGRUPAMENTO'         => 2,
                'UNI_IDIMOVEL'              => 1,
                'UNI_NOME'                  => '104',
                'UNI_RESPONSAVEL'           => 'Maria Marta',
                'UNI_CPFRESPONSAVEL'        => '444.444.444-00',
                'UNI_TELRESPONSAVEL'        => '(61) 3232-5566',
                'created_at' => Carbon::now()->format('Y-m-d H:i'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i')
        ]);

        Unidade::create([
                'UNI_ID'                    => 5,
                'UNI_IDAGRUPAMENTO'         => 2,
                'UNI_IDIMOVEL'              => 1,
                'UNI_NOME'                  => '105',
                'UNI_RESPONSAVEL'           => 'Otávio Julio',
                'UNI_CPFRESPONSAVEL'        => '777.777.777-22',
                'UNI_TELRESPONSAVEL'        => '(61) 7747-1425',
                'created_at' => Carbon::now()->format('Y-m-d H:i'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i')
        ]);

        
    }
}
