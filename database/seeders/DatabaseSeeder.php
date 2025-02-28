<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

// how to run this file
//$ php artisan db:seed
class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Seed Companies
        DB::table('companies')->insert([
            ['name' => 'Arreta Pharmaceuticals', 'created_at' => now(), 'updated_at' => now()]
        ]);

        // Seed Users
        DB::table('users')->insert([
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'cnic' => '1234567890123',
                'contact' => '1234567890',
                'company_id' => 1,
                'entry_user_id' => 1,
                'entry_date' => Carbon::now(),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'name' => 'Normal User',
                'email' => 'user@example.com',
                'password' => Hash::make('password'),
                'cnic' => '1234567890123',
                'contact' => '1234567890',
                'department_id' => 1,
                'designation_id' => 1,
                'company_id' => 1,
                'entry_user_id' => 1,
                'entry_date' => Carbon::now(),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        // Seed Departments
        DB::table('departments')->insert([
            ['description' => 'HR', 'company_id' => 1, 'entry_user_id' => 1, 'entry_date' => now(), 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['description' => 'IT', 'company_id' => 1, 'entry_user_id' => 1, 'entry_date' => now(), 'is_active' => true, 'created_at' => now(), 'updated_at' => now()]
        ]);

        // Seed Roles
        DB::table('roles')->insert([
            ['description' => 'Administrator', 'company_id' => 1, 'entry_user_id' => 1, 'entry_date' => now(), 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['description' => 'Employee', 'company_id' => 1, 'entry_user_id' => 1, 'entry_date' => now(), 'is_active' => true, 'created_at' => now(), 'updated_at' => now()]
        ]);

        // Seed Designations
        DB::table('designations')->insert([
            ['description' => 'Manager', 'company_id' => 1, 'entry_user_id' => 1, 'entry_date' => now(), 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['description' => 'Staff', 'company_id' => 1, 'entry_user_id' => 1, 'entry_date' => now(), 'is_active' => true, 'created_at' => now(), 'updated_at' => now()]
        ]);

        // Seed Leave Types
        DB::table('leave_types')->insert([
            ['description' => 'Sick Leave', 'created_at' => now(), 'updated_at' => now()],
            ['description' => 'Casual Leave', 'created_at' => now(), 'updated_at' => now()],
            ['description' => 'Annual Leave', 'created_at' => now(), 'updated_at' => now()]
        ]);

        // Seed Reference Pay Head Types
        DB::table('ref_pay_head_types')->insert([
            ['description' => 'Earnings', 'company_id' => 1, 'entry_user_id' => 1, 'entry_date' => now(), 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['description' => 'Deductions', 'company_id' => 1, 'entry_user_id' => 1, 'entry_date' => now(), 'is_active' => true, 'created_at' => now(), 'updated_at' => now()]
        ]);

        // Seed Reference Pay Heads
        DB::table('ref_pay_heads')->insert([
            ['description' => 'Basic Salary', 'ref_pay_head_type_id' => 1, 'company_id' => 1, 'entry_user_id' => 1, 'entry_date' => now(), 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['description' => 'Tax Deduction', 'ref_pay_head_type_id' => 2, 'company_id' => 1, 'entry_user_id' => 1, 'entry_date' => now(), 'is_active' => true, 'created_at' => now(), 'updated_at' => now()]
        ]);
    }
}
