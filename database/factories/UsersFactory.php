<?php

namespace Database\Factories;

use App\Models\Users;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UsersFactory extends Factory
{
    // Menentukan model yang digunakan oleh factory
    protected $model = Users::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'role' => $this->faker->randomElement(['admin', 'pengajar', 'pelajar']),
            'password' => bcrypt('password'), // Password yang terenkripsi
            // Tambahkan field lain sesuai kebutuhan model User Anda, misalnya 'role'
        ];
    }
}
