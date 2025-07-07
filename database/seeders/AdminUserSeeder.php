<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin1',
            'email' => 'admin123@gmail.com',
            'phone_number' => '7041134556',
            'role' => 'admin',
            'password' => Hash::make('password123'), // You can change the password
        ]);

        User::create([
            'name' => 'admin2',
            'email' => 'admin2@gmail.com',
            'phone_number' => '9979202377',
            'role' => 'admin',
            'password' => Hash::make('password123'),
        ]);
    }
}