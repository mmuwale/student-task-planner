<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProjectSeeder extends Seeder
{
    public function run()
    {
        $projects = [
            [
                'name' => 'Final Year Project',
                'description' => 'Complete final year project documentation and implementation',
                'due_date' => Carbon::now()->addMonths(3),
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Web Development Coursework',
                'description' => 'All assignments and projects for web development course',
                'due_date' => Carbon::now()->addMonth(),
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('projects')->insert($projects);
    }
}