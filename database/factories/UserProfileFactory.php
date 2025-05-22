<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User_profile>
 */
class UserProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'city' => $this->faker->city(),
            'state' => $this->faker->state(),
            'country' => $this->faker->country(),
            'qualification' => $this->faker->randomElement(['B.Tech','bca','M.Sc IT', 'MCA', 'B.Sc IT']),
            'certificates' => 'Laravel Certification, AWS Certified Developer',
            'resume' => 'resumes/sample_resume.pdf', // static or fake path
            'experience' => $this->faker->paragraph(),
            'summary' => $this->faker->sentence(),
            'github' => $this->faker->url(),
            'linkedin' => $this->faker->url(),
            'skills' => 'PHP, Laravel, MySQL, Git',
        ];
    }
}
