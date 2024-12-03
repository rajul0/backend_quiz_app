<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quiz;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Quiz::create([
            'nama' => 'Math Quiz',
            'daftar_pertanyaan' => [
                [
                    'pertanyaan' => 'What is 2 + 2?',
                    'opsi' => ['3', '4', '5'],
                    'jawaban' => '4',
                    'jenis_pertanyaan' => 'Pilihan ganda',
                    'nilai' => 5,
                    'waktu_pertanyaan' => 15
                ],
                [
                    'question' => 'What is 10 / 2?',
                    'opsi' => ['2', '5', '10'],
                    'jawaban' => '5',
                    'jenis_pertanyaan' => 'Pilihan ganda',
                    'nilai' => 5,
                    'waktu_pertanyaan' => 15
                ],
            ],
        ]);

        Quiz::create([
            'nama' => 'History Quiz',
            'daftar_pertanyaan' => [
                [
                    'question' => 'Who discovered America?',
                    'opsi' => ['Columbus', 'Magellan', 'Vespucci'],
                    'jawaban' => 'Columbus',
                    'jenis_pertanyaan' => 'Pilihan ganda',
                    'nilai' => 5,
                    'waktu_pertanyaan' => 15
                ],
                [
                    'question' => 'When did WW2 end?',
                    'opsi' => ['1945', '1939', '1950'],
                    'jawaban' => '1945',
                    'jenis_pertanyaan' => 'Pilihan ganda',
                    'nilai' => 5,
                    'waktu_pertanyaan' => 15
                ],
            ],
        ]);

        Quiz::create([
            'nama' => 'Science Quiz',
            'daftar_pertanyaan' => [
                [
                    'question' => 'What is the chemical symbol for water?',
                    'opsi' => ['H2O', 'O2', 'CO2'],
                    'jawaban' => 'H2O',
                    'jenis_pertanyaan' => 'Pilihan ganda',
                    'nilai' => 5,
                    'waktu_pertanyaan' => 15
                ],
                [
                    'question' => 'What planet is known as the Red Planet?',
                    'opsi' => ['Mars', 'Venus', 'Jupiter'],
                    'jawaban' => 'Mars',
                    'jenis_pertanyaan' => 'Pilihan ganda',
                    'nilai' => 5,
                    'waktu_pertanyaan' => 15
                ],
            ],
        ]);
    }
}
