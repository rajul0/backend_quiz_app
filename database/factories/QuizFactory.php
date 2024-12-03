<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Quiz>
 */
class QuizFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3), // Membuat judul acak
            'questions' => [
                [
                    'question' => $this->faker->sentence(6), // Pertanyaan acak
                    'options' => [
                        $this->faker->word,
                        $this->faker->word,
                        $this->faker->word,
                        $this->faker->word,
                    ],
                    'answer' => $this->faker->word, // Jawaban acak
                    'duration' => $this->faker->word, // Jawaban acak
                ],
                [
                    'question' => $this->faker->sentence(6), // Pertanyaan acak
                    'options' => [
                        $this->faker->word,
                        $this->faker->word,
                        $this->faker->word,
                        $this->faker->word,
                    ],
                    'answer' => $this->faker->word, // Jawaban acak
                ],
            ],
        ];
    }
}
