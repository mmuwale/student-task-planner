<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Course; // ADD THIS LINE

class TaskSeeder extends Seeder
{
    public function run()
    {
        $user = User::first();
        $courses = Course::all(); // This will work now

        $tasks = [
            [
                'user_id' => $user->id,
                'course_id' => $courses->first()->id,
                'title' => 'Programming Assignment 1',
                'description' => 'Complete basic programming exercises',
                'due_date' => now()->addDays(7),
                'due_time' => '23:59:00',
                'priority' => 'high',
                'status' => 'todo',
                'estimated_duration' => 120, // minutes
                'type' => 'assignment',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $user->id,
                'course_id' => $courses->first()->id,
                'title' => 'Midterm Exam Study',
                'description' => 'Study chapters 1-5 for midterm exam',
                'due_date' => now()->addDays(14),
                'due_time' => '09:00:00',
                'priority' => 'urgent',
                'status' => 'todo',
                'estimated_duration' => 300, // minutes
                'type' => 'study',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $user->id,
                'course_id' => $courses->skip(1)->first()->id,
                'title' => 'Data Structures Project',
                'description' => 'Implement linked list and binary tree',
                'due_date' => now()->addDays(10),
                'due_time' => '17:00:00',
                'priority' => 'high',
                'status' => 'todo',
                'estimated_duration' => 180, // minutes
                'type' => 'project',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $user->id,
                'course_id' => $courses->skip(2)->first()->id,
                'title' => 'Calculus Problem Set',
                'description' => 'Complete derivative problems',
                'due_date' => now()->addDays(3),
                'due_time' => '14:30:00',
                'priority' => 'medium',
                'status' => 'todo',
                'estimated_duration' => 90, // minutes
                'type' => 'assignment',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('tasks')->insert($tasks);
    }
}