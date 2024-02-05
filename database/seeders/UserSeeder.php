<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'full_name' => 'Paula Muñoz',
            'email' => 'paula@gmail.com',
            'password' => Hash::make('12345678')
        ]);

        User::create([
            'full_name' => 'Jon Doe',
            'email' => 'jondoe@gmail.com',
            'password' => Hash::make('123456789')
        ]);

        //Crea 10 registros en la tabla users aletoriamente
        User::factory(10)->create();
    }
}
