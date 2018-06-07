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
        User::create([
            'name' => 'Flavio Silva',
            'email' => 'flaviomau@yahoo.com',
            'password' => bcrypt('123456')
        ]);
    }
}
