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
            'name' => 'Phan Quang Dương',
            'username' => 'quangduong',
            'email' => 'quangduongsayhi@gmail.com',
            'password' => Hash::make('12345'),
            'avatar' => 'https://res.cloudinary.com/lms-platform/image/upload/v1724758510/images/4aad98380d00a122ec506ba3a9c969f9_uxrdhb.jpg'
        ]);

        User::create([
            'name' => 'User',
            'username' => 'user',
            'email' => 'user@example.com',
            'password' => Hash::make('12345'),
            'avatar' => 'https://res.cloudinary.com/lms-platform/image/upload/v1724758510/images/4aad98380d00a122ec506ba3a9c969f9_uxrdhb.jpg'
        ]);
    }
}