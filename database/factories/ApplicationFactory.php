<?php

namespace Database\Factories;

use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Application>
 */
class ApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           'job_id' => Job::inRandomOrder()->first()->id ?? 1,
           'user_id' => User::inRandomOrder()->first()->id ?? 1,
           'Cover_letter' => $this->faker->paragraph(2),
           'created_at' => now(),
           'updated_at' => now(),
        ];
    }
}
