<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $admin->assignRole('admin');

        \App\Models\InstructorProfile::create([
            'user_id' => $admin->id,
            'headline' => 'Platform Administrator',
        ]);

        \App\Models\StudentProfile::create([
            'user_id' => $admin->id,
        ]);
    }
}
