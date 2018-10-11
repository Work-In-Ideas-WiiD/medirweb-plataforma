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
                'AGR_TAXAFIXA'              => NULL,
                'AGR_TAXAVARIAVEL'          => NULL,
                'created_at'                => Carbon::now()->format('Y-m-d H:i'),
                'updated_at'                => Carbon::now()->format('Y-m-d H:i')
        ]);

        Agrupamento::create([
            'AGR_ID'                    => 2,
            'AGR_IDIMOVEL'              => 1,
            'AGR_NOME'                  => 'Torre 2',
            'AGR_TAXAFIXA'              => NULL,
            'AGR_TAXAVARIAVEL'          => NULL,
            'created_at'                => Carbon::now()->format('Y-m-d H:i'),
            'updated_at'                => Carbon::now()->format('Y-m-d H:i')
        ]);

        Agrupamento::create([
            'AGR_ID'                    => 3,
            'AGR_IDIMOVEL'              => 1,
            'AGR_NOME'                  => 'Torre 3',
            'AGR_TAXAFIXA'              => NULL,
            'AGR_TAXAVARIAVEL'          => NULL,
            'created_at'                => Carbon::now()->format('Y-m-d H:i'),
            'updated_at'                => Carbon::now()->format('Y-m-d H:i')
        ]);

        Agrupamento::create([
            'AGR_ID'                    => 4,
            'AGR_IDIMOVEL'              => 1,
            'AGR_NOME'                  => 'Torre 4',
            'AGR_TAXAFIXA'              => NULL,
            'AGR_TAXAVARIAVEL'          => NULL,
            'created_at'                => Carbon::now()->format('Y-m-d H:i'),
            'updated_at'                => Carbon::now()->format('Y-m-d H:i')
        ]);

        Agrupamento::create([
            'AGR_ID'                    => 5,
            'AGR_IDIMOVEL'              => 1,
            'AGR_NOME'                  => 'Torre 5',
            'AGR_TAXAFIXA'              => NULL,
            'AGR_TAXAVARIAVEL'          => NULL,
            'created_at'                => Carbon::now()->format('Y-m-d H:i'),
            'updated_at'                => Carbon::now()->format('Y-m-d H:i')
        ]);

        Agrupamento::create([
            'AGR_ID'                    => 6,
            'AGR_IDIMOVEL'              => 1,
            'AGR_NOME'                  => 'Torre 6',
            'AGR_TAXAFIXA'              => NULL,
            'AGR_TAXAVARIAVEL'          => NULL,
            'created_at'                => Carbon::now()->format('Y-m-d H:i'),
            'updated_at'                => Carbon::now()->format('Y-m-d H:i')
        ]);

        Agrupamento::create([
            'AGR_ID'                    => 7,
            'AGR_IDIMOVEL'              => 1,
            'AGR_NOME'                  => 'Torre 7',
            'AGR_TAXAFIXA'              => NULL,
            'AGR_TAXAVARIAVEL'          => NULL,
            'created_at'                => Carbon::now()->format('Y-m-d H:i'),
            'updated_at'                => Carbon::now()->format('Y-m-d H:i')
        ]);

        Agrupamento::create([
            'AGR_ID'                    => 8,
            'AGR_IDIMOVEL'              => 1,
            'AGR_NOME'                  => 'Torre 8',
            'AGR_TAXAFIXA'              => NULL,
            'AGR_TAXAVARIAVEL'          => NULL,
            'created_at'                => Carbon::now()->format('Y-m-d H:i'),
            'updated_at'                => Carbon::now()->format('Y-m-d H:i')
        ]);

        Agrupamento::create([
            'AGR_ID'                    => 9,
            'AGR_IDIMOVEL'              => 1,
            'AGR_NOME'                  => 'Torre 9',
            'AGR_TAXAFIXA'              => NULL,
            'AGR_TAXAVARIAVEL'          => NULL,
            'created_at'                => Carbon::now()->format('Y-m-d H:i'),
            'updated_at'                => Carbon::now()->format('Y-m-d H:i')
        ]);

        Agrupamento::create([
            'AGR_ID'                    => 10,
            'AGR_IDIMOVEL'              => 1,
            'AGR_NOME'                  => 'Torre 10',
            'AGR_TAXAFIXA'              => NULL,
            'AGR_TAXAVARIAVEL'          => NULL,
            'created_at'                => Carbon::now()->format('Y-m-d H:i'),
            'updated_at'                => Carbon::now()->format('Y-m-d H:i')
        ]);

        Agrupamento::create([
            'AGR_ID'                    => 11,
            'AGR_IDIMOVEL'              => 1,
            'AGR_NOME'                  => 'Torre 11',
            'AGR_TAXAFIXA'              => NULL,
            'AGR_TAXAVARIAVEL'          => NULL,
            'created_at'                => Carbon::now()->format('Y-m-d H:i'),
            'updated_at'                => Carbon::now()->format('Y-m-d H:i')
        ]);

        Agrupamento::create([
            'AGR_ID'                    => 12,
            'AGR_IDIMOVEL'              => 1,
            'AGR_NOME'                  => 'Torre 12',
            'AGR_TAXAFIXA'              => NULL,
            'AGR_TAXAVARIAVEL'          => NULL,
            'created_at'                => Carbon::now()->format('Y-m-d H:i'),
            'updated_at'                => Carbon::now()->format('Y-m-d H:i')
        ]);

        
    }
}
