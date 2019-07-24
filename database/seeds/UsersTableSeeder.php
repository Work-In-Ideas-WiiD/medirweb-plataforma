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

        $roleAdmin = Defender::createRole('Administrador');
        Defender::createRole('Sindico');
        Defender::createRole('Secretário');
        Defender::createRole('Comum');
        Defender::createRole('Vendedor');

        $users = [
            [
                'name' => 'Work In Ideas - WiiD',
                'email' => 'contato@wi-id.com',
                'password' => bcrypt('secret')
            ],
            [
                'name' => 'MedirWeb Admin',
                'email' => 'contato@medirweb.com',
                'password' => bcrypt('secret')
            ]
        ];


        foreach ($users as $user)
            User::create($user)->roles()->attach($roleAdmin);


    }
}
