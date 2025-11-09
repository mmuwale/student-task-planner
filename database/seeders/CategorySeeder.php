<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Academic', 'color' => '#3b82f6'],
            ['name' => 'Personal', 'color' => '#10b981'],
            ['name' => 'Group Project', 'color' => '#f59e0b'],
            ['name' => 'Research', 'color' => '#ef4444'],
            ['name' => 'Extracurricular', 'color' => '#8b5cf6'],
            // New academic-specific categories
            ['name' => 'Assignment', 'color' => '#3b82f6'],
            ['name' => 'Exam', 'color' => '#ef4444'],
            ['name' => 'Quiz', 'color' => '#f59e0b'],
            ['name' => 'Project', 'color' => '#8b5cf6'],
        ];

        DB::table('categories')->insert($categories);
    }
}