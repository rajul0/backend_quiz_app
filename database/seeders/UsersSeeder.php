<?php
// database/seeders/UserSeeder.php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        // Membuat 3 pengguna dengan role yang berbeda
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@quiz.com',
            // 'role' => 'admin',
            'password' => bcrypt('admin123'),
        ]);

        User::factory()->create([
            'name' => 'Pengajar',
            'email' => 'pengajar@quiz.com',
            // 'role' => 'pengajar',
            'password' => bcrypt('pengajar123'),
        ]);

        User::factory()->create([
            'name' => 'Pelajar',
            'email' => 'pelajar@quiz.com',
            // 'role' => 'pelajar',
            'password' => bcrypt('pelajar123'),
        ]);
    }
}
