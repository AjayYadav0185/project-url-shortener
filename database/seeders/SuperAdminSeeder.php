<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing users (optional, useful for testing)
        DB::table('users')->truncate();

        // SuperAdmin
        DB::table('users')->insert([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('password123'),
            'role' => 'SuperAdmin',
            'company_id' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Admin
        DB::table('users')->insert([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'role' => 'Admin',
            'company_id' => 1, // make sure company 1 exists
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Member
        DB::table('users')->insert([
            'name' => 'Member User',
            'email' => 'member@example.com',
            'password' => Hash::make('password123'),
            'role' => 'Member',
            'company_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Sales
        DB::table('users')->insert([
            'name' => 'Sales User',
            'email' => 'sales@example.com',
            'password' => Hash::make('password123'),
            'role' => 'Sales',
            'company_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Manager
        DB::table('users')->insert([
            'name' => 'Manager User',
            'email' => 'manager@example.com',
            'password' => Hash::make('password123'),
            'role' => 'Manager',
            'company_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->command->info('Seeded all roles successfully!');
    }
}
