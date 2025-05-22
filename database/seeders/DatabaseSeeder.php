<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\User;
use App\Models\Application;
use App\Models\UserProfile;
use Database\Factories\UserProfileFactory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory()->count(30)->create();
        // Job::factory()->count(50)->create();
        // Application::factory()->count(100)->create();
        UserProfile::factory()->count(30)->create();
    }
}
