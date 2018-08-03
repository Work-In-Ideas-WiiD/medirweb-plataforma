<?php

use Illuminate\Database\Seeder;
use App\Models\Agrupamento;

use Carbon\Carbon;

class AgrupamentosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('agrupamentos')->delete();

        Agrupamento::create([
                'AGR_ID'                    => 1,
                'AGR_IDIMOVEL'              => 1,
                'AGR_NOME'                  => 'Torre 1',
                'created_at' => Carbon::now()->format('Y-m-d H:i'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i')
        ]);

        Agrupamento::create([
                'AGR_ID'                    => 2,
                'AGR_IDIMOVEL'              => 1,
                'AGR_NOME'                  => 'Torre 2',
                'created_at' => Carbon::now()->format('Y-m-d H:i'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i')
        ]);

        Agrupamento::create([
                'AGR_ID'                    => 3,
                'AGR_IDIMOVEL'              => 1,
                'AGR_NOME'                  => 'Torre 3',
                'created_at' => Carbon::now()->format('Y-m-d H:i'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i')
        ]);

        
    }
}
