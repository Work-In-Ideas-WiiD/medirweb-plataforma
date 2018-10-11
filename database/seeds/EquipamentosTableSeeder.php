<?php

use Illuminate\Database\Seeder;
use App\Models\Equipamento;

use Carbon\Carbon;

class EquipamentosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('equipamentos')->delete();

        Equipamento::create([
            'EQP_IDUNIDADE'             => 1,
            'EQP_IDFUNCIONAL'           => 1,
            'EQP_SERIAL'                => 100-000-001,
            'EQP_FABRICANTE'            => 'Panasonic',
            'EQP_MODELO'                => 'X12',
            'EQP_OPERADORA'             => 'VIVO',
            'EQP_STATUS'                => 1,
            'created_at'                => Carbon::now()->format('Y-m-d H:i'),
            'updated_at'                => Carbon::now()->format('Y-m-d H:i')
        ]);
    }
}
