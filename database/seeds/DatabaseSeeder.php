<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PaisSeeder::class);
        $this->call(EstadosTableSeeder::class);
        $this->call(CidadesTableSeeder::class);
        $this->call(ClientesTableSeeder::class);
        $this->call(ImoveisTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(AgrupamentosTableSeeder::class);
        $this->call(UnidadesTableSeeder::class);
        $this->call(PrumadasTableSeeder::class);
        $this->call(LeiturasTableSeeder::class);
    }
}
