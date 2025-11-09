<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class StudentCourseSeeder extends Seeder
{
    public function run()
    {
        // Create a user if none exists
        $user = User::first();
        if (!$user) {
            $user = User::factory()->create([
                'name' => 'Test Student',
                'email' => 'student@example.com',
            ]);
        }

        $studentCourses = [
            [
                'user_id' => $user->id,
                'course_id' => 1, // ICS 1201
                'status' => 'active',
                'current_grade' => 85.5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $user->id,
                'course_id' => 2, // ICS 2102
                'status' => 'active',
                'current_grade' => 92.0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $user->id,
                'course_id' => 3, // MAT 1101
                'status' => 'active',
                'current_grade' => 78.0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('student_courses')->insert($studentCourses);
    }
}