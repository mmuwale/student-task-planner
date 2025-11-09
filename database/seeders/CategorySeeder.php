<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Academic', 'color' => '#3b82f6'],
            ['name' => 'Personal', 'color' => '#10b981'],
            ['name' => 'Group Project', 'color' => '#f59e0b'],
            ['name' => 'Research', 'color' => '#ef4444'],
            ['name' => 'Extracurricular', 'color' => '#8b5cf6'],
        ];

        DB::table('categories')->insert($categories);
    }
}
