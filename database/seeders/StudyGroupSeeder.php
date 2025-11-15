<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Task;

class StudyGroupSeeder extends Seeder
{
    public function run()
    {
        // Get the test user and some tasks
        $user = User::first();
        $tasks = Task::all();

        // Check if we have tasks, if not create some
        if ($tasks->isEmpty()) {
            $this->command->info('No tasks found. Please run TaskSeeder first.');
            return;
        }

        $studyGroups = [
            [
                'name' => 'ICS 1201 Project Team',
                'description' => 'Working on the final programming project together',
                'task_id' => $tasks->first()->id,
                'created_by' => $user->id,
                'max_members' => 4,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Data Structures Study Group',
                'description' => 'Weekly study sessions for exams',
                'task_id' => $tasks->count() > 1 ? $tasks->skip(1)->first()->id : $tasks->first()->id,
                'created_by' => $user->id,
                'max_members' => 6,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('study_groups')->insert($studyGroups);

        // Add group members
        $studyGroupIds = DB::table('study_groups')->pluck('id');

        $groupMembers = [];
        
        foreach ($studyGroupIds as $groupId) {
            // Add the creator as a member with leader role
            $groupMembers[] = [
                'study_group_id' => $groupId,
                'user_id' => $user->id,
                'role' => 'leader',
                'joined_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('group_members')->insert($groupMembers);
    }
}