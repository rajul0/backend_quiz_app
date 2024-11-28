<?php
// database/seeders/UserSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Users;

class UsersSeeder extends Seeder
{
    public function run()
    {
        // Membuat 3 pengguna dengan role yang berbeda
        Users::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'password' => bcrypt('admin123'),
        ]);

        Users::factory()->create([
            'name' => 'Pengajar',
            'email' => 'pengajar@example.com',
            'role' => 'pengajar',
            'password' => bcrypt('pengajar123'),
        ]);

        Users::factory()->create([
            'name' => 'Pelajar',
            'email' => 'pelajar@example.com',
            'role' => 'pelajar',
            'password' => bcrypt('pelajar123'),
        ]);
    }
}
