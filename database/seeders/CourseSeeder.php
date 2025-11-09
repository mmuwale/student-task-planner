<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    public function run()
    {
        $courses = [
            [
                'course_code' => 'ICS 1201',
                'name' => 'Introduction to Programming',
                'description' => 'Fundamentals of programming and algorithms',
                'instructor' => 'Dr. Smith',
                'color' => '#3b82f6',
                'credit_hours' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_code' => 'ICS 2102',
                'name' => 'Data Structures and Algorithms',
                'description' => 'Advanced data structures and algorithm analysis',
                'instructor' => 'Prof. Johnson',
                'color' => '#ef4444',
                'credit_hours' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_code' => 'MAT 1101',
                'name' => 'Calculus I',
                'description' => 'Differential and integral calculus',
                'instructor' => 'Dr. Brown',
                'color' => '#10b981',
                'credit_hours' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('courses')->insert($courses);
    }
}