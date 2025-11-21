<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            [
                'name' => 'student',
                'description' => 'Regular student user',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'admin',
                'description' => 'System administrator',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('roles')->insert($roles);
        
        // Assign student role to all existing users by default
        $studentRole = DB::table('roles')->where('name', 'student')->first();
        $users = DB::table('users')->pluck('id');
        
        $userRoles = [];
        foreach ($users as $userId) {
            $userRoles[] = [
                'user_id' => $userId,
                'role_id' => $studentRole->id,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        
        DB::table('user_roles')->insert($userRoles);
        
        // Optionally: Assign admin role to the first user
        DB::table('user_roles')->insert([
            'user_id' => 1, // First user
            'role_id' => DB::table('roles')->where('name', 'admin')->first()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}