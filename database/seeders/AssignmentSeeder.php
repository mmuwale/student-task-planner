<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AssignmentSeeder extends Seeder
{
    public function run()
    {
        $assignments = [
            // ICS 1201 Assignments
            [
                'course_id' => 1,
                'title' => 'Programming Basics Assignment',
                'description' => 'Write simple programs demonstrating basic programming concepts like variables, loops, and conditionals.',
                'instructions' => 'Submit your Python files with proper comments. Each program should solve a specific problem.',
                'type' => 'assignment',
                'max_points' => 100,
                'due_date' => Carbon::now()->addDays(7),
                'start_date' => Carbon::now()->subDays(2),
                'priority' => 'high',
                'estimated_hours' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_id' => 1,
                'title' => 'Midterm Exam',
                'description' => 'Comprehensive exam covering all topics from weeks 1-6.',
                'instructions' => 'Closed book exam. Bring your student ID and calculator.',
                'type' => 'exam',
                'max_points' => 100,
                'due_date' => Carbon::now()->addDays(14),
                'start_date' => Carbon::now()->addDays(13),
                'priority' => 'urgent',
                'estimated_hours' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_id' => 1,
                'title' => 'Final Project - Calculator App',
                'description' => 'Create a functional calculator application with a GUI.',
                'instructions' => 'Use any programming language of your choice. Include basic arithmetic operations and a clear user interface.',
                'type' => 'project',
                'max_points' => 150,
                'due_date' => Carbon::now()->addDays(30),
                'start_date' => Carbon::now()->addDays(7),
                'priority' => 'medium',
                'estimated_hours' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // ICS 2102 Assignments
            [
                'course_id' => 2,
                'title' => 'Linked List Implementation',
                'description' => 'Implement a singly linked list with basic operations.',
                'instructions' => 'Submit your code with proper documentation and test cases.',
                'type' => 'assignment',
                'max_points' => 100,
                'due_date' => Carbon::now()->addDays(5),
                'start_date' => Carbon::now()->subDays(1),
                'priority' => 'high',
                'estimated_hours' => 8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_id' => 2,
                'title' => 'Algorithm Analysis Quiz',
                'description' => 'Quiz on time complexity and Big O notation.',
                'instructions' => '30-minute online quiz. Available from 9 AM to 9 PM.',
                'type' => 'quiz',
                'max_points' => 50,
                'due_date' => Carbon::now()->addDays(3),
                'start_date' => Carbon::now()->addDays(2),
                'priority' => 'urgent',
                'estimated_hours' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('assignments')->insert($assignments);
    }
}