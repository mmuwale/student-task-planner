<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TaskSeeder extends Seeder
{
    public function run()
    {
        $tasks = [
            [
                'title' => 'Research Proposal',
                'description' => 'Write and submit research proposal for final project',
                'due_date' => Carbon::now()->addWeek(),
                'priority' => 'high',
                'status' => 'pending',
                'project_id' => 1,
                'category_id' => 4,
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Literature Review',
                'description' => 'Complete literature review chapter',
                'due_date' => Carbon::now()->addWeeks(2),
                'priority' => 'medium',
                'status' => 'pending',
                'project_id' => 1,
                'category_id' => 4,
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Create Database Schema',
                'description' => 'Design and implement database schema for web application',
                'due_date' => Carbon::now()->addDays(3),
                'priority' => 'high',
                'status' => 'in_progress',
                'project_id' => 2,
                'category_id' => 3,
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('tasks')->insert($tasks);

        // Assign tasks to users
        $taskAssignments = [
            ['task_id' => 1, 'user_id' => 1, 'role' => 'assignee'],
            ['task_id' => 2, 'user_id' => 1, 'role' => 'assignee'],
            ['task_id' => 3, 'user_id' => 1, 'role' => 'assignee'],
        ];

        DB::table('task_user')->insert($taskAssignments);
    }
}