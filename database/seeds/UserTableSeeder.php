<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'nombre' => 'admin',
            'email' => 'admin@gmail.com',
            'fecha' => '2020-03-24',
            'password' => Hash::make('123123'),
            //'persona_id' => 1,
            'rol_id' => 1,
            'created_at' => '2020-03-24 20:09:57',
        ]);
        $admin->assignRole('administrador');
    }
}
