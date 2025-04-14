<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [
                'name' => 'Admin',
                'email'=> 'admin@gmail.com',
                'password'=> Hash::make('123'),
                'role' => 'admin'
            ],
            [
                'name' => 'Petugas',
                'email'=> 'petugas@gmail.com',
                'password'=> Hash::make('123'),
                'role' => 'petugas'
            ]
        ];

        foreach($user as $key => $value){
            User::create($value);
        };
    }
}
