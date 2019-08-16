<?php

use Illuminate\Database\Seeder;

use App\Models\Pais;

class PaisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pais::insert([
            'nome' => 'Brasil',
            'codigo' => 'BR'
        ]);
    }
}
