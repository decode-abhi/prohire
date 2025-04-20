<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           'title' => $this->faker->jobTitle(),
           'description' => $this->faker->paragraph(3),
           'location' => $this->faker->city(),
           'type' => $this->faker->randomElement(['Full-time', 'Part-time', 'Internship']),
           'salary' => $this->faker->numberBetween(30000,120000),
           'user_id' => User::inRandomOrder()->first()->id ?? 1,
           'created_at' => now(),
           'updated_at' => now(),
        ];
    }
}
