<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::create([
            'name' => 'Brayan',
            'lastname' => 'Aquino',
            'email' => 'brayan@gmail.com',
            'password' => Hash::make('123456789'),
            'cellphone' => '987654321',
            'dni'=> '12345678',
            'hiring_date' => now(),
            'qr_info' => '12345678/brayan@gmail.com',
            'state' => 'activo',
            'rol_id' => 1,
        ]);
        User::create([
            'name' => 'Jean',
            'lastname' => 'Barrial',
            'email' => 'jean@gmail.com',
            'password' => Hash::make('123456789'),
            'cellphone' => '987654321',
            'dni'=> '12345679',
            'hiring_date' => now(),
            'qr_info' => '12345679/jean@gmail.com',
            'state' => 'activo',
            'rol_id' => 2,
        ]);
        User::create([
            'name' => 'Jhosep',
            'lastname' => 'Melchor',
            'email' => 'jhosep@gmail.com',
            'password' => Hash::make('123456789'),
            'cellphone' => '987654321',
            'dni'=> '12345677',
            'hiring_date' => now(),
            'qr_info' => '12345677/jhosep@gmail.com',
            'state' => 'activo',
            'rol_id' => 3,
        ]);
    }
}
