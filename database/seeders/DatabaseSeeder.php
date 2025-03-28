<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Seed companies
        DB::table('companies')->insert([
            ['name' => 'Tech Corp', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Biz Solutions', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Seed departments
        DB::table('departments')->insert([
            ['description' => 'IT', 'company_id' => 1, 'entry_user_id' => 1, 'is_active' => true, 'entry_date' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['description' => 'HR', 'company_id' => 2, 'entry_user_id' => 1, 'is_active' => true, 'entry_date' => now(), 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Seed roles
        DB::table('roles')->insert([
            ['description' => 'Admin', 'company_id' => 1, 'entry_user_id' => 1, 'is_active' => true, 'entry_date' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['description' => 'Employee', 'company_id' => 2, 'entry_user_id' => 1, 'is_active' => true, 'entry_date' => now(), 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Seed users
        DB::table('users')->insert([
            [
                'name' => 'John Doe',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'cnic' => '12345-6789012-3',
                'contact' => '1234567890',
                'department_id' => 1,
                'role_id' => 1,
                'designation_id' => null,
                'company_id' => 1,
                'entry_user_id' => 1,
                'entry_date' => now(),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
                'remember_token' => Str::random(10),
            ],
        ]);

        // Seed leave types
        DB::table('leave_types')->insert([
            ['description' => 'Sick Leave', 'company_id' => 1, 'entry_user_id' => 1, 'is_active' => true, 'entry_date' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['description' => 'Annual Leave', 'company_id' => 1, 'entry_user_id' => 1, 'is_active' => true, 'entry_date' => now(), 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
