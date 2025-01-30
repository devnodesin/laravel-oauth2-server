<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@domain.com',
            'password' => Hash::make('admin'),
            'role' => 'admin',
            'status' => 'active',
            'permissions' => ['all'],
            'designation' => 'System Administrator',
            'email_verified_at' => now(),
        ]);

        // Create manager user
        $manager = User::factory()->create([
            'name' => 'Manager User',
            'email' => 'manager@domain.com',
            'password' => Hash::make('manager'),
            'role' => 'manager',
            'status' => 'active',
            'permissions' => ['client', 'finance', 'report'],
            'designation' => 'Project Manager',
            'created_by' => $admin->id,
            'email_verified_at' => now(),
        ]);

        // Create 5 regular users
        User::factory(2)->create([
            'role' => 'user',
            'password' => Hash::make('user'),
            'created_by' => $admin->id,
        ]);
    }
}
