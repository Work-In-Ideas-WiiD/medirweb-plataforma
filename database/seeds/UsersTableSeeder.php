<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        User::create([
            'name'                  => 'Usuario 1',
            'email'                 => 'brasilia1@usuario.com.br',
            'password'              => bcrypt('123456'),
        ]);
    }
}
