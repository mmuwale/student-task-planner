<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create a test user first
        User::factory()->create([
            'name' => 'Test Student',
            'email' => 'student@example.com',
        ]);

        $this->call([
            CategorySeeder::class,
            CourseSeeder::class,
            AssignmentSeeder::class,
            StudentCourseSeeder::class,
            // TaskSeeder::class, // Comment this out for now if it exists
        ]);
    }
}