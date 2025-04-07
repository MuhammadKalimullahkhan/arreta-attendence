<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Seed Companies
        $companyId = DB::table('companies')->insertGetId([
            'name' => 'Tech Corp',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Seed Departments
        $departmentId = DB::table('departments')->insertGetId([
            'description' => 'IT Department',
            'company_id' => $companyId,
            'entry_user_id' => 1,
            'entry_date' => now(),
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Seed Roles
        $roleId = DB::table('roles')->insertGetId([
            'description' => 'Administrator',
            'company_id' => $companyId,
            'entry_user_id' => 1,
            'entry_date' => now(),
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Seed Designations
        $designationId = DB::table('designations')->insertGetId([
            'description' => 'Software Engineer',
            'company_id' => $companyId,
            'entry_user_id' => 1,
            'entry_date' => now(),
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Seed Users
        $userId = DB::table('users')->insertGetId([
            'name' => 'John Doe',
            'email' => 'admin@techcorp.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'cnic' => '12345-6789012-3',
            'contact' => '1234567890',
            'department_id' => $departmentId,
            'role_id' => $roleId,
            'designation_id' => $designationId,
            'company_id' => $companyId,
            'entry_user_id' => 1,
            'entry_date' => now(),
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
            'remember_token' => 'token',
        ]);

        // Seed Attendance
        DB::table('attendances')->insert([
            'employee_id' => $userId,
            'designation_id' => $designationId,
            'year_id' => now()->year,
            'month_id' => now()->month,
            'date' => now()->toDateString(),
            'status' => 'Present',
            'is_present' => true,
            'company_id' => $companyId,
            'entry_user_id' => $userId,
            'entry_date' => now(),
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Seed Leave Types
        $leaveTypeId = DB::table('leave_types')->insertGetId([
            'description' => 'Annual Leave',
            'company_id' => $companyId,
            'entry_user_id' => $userId,
            'is_active' => true,
            'entry_date' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Seed Leaves
        DB::table('leaves')->insert([
            'employee_id' => $userId,
            'designation_id' => $designationId,
            'leave_type_id' => $leaveTypeId,
            'from_date' => now()->toDateString(),
            'number_of_days' => 5,
            'approval' => 'Approved',
            'approval_date' => now()->toDateString(),
            'paid_leave' => false,
            'company_id' => $companyId,
            'entry_user_id' => $userId,
            'entry_date' => now(),
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Seed Pay Head Types
        $payHeadTypeId = DB::table('ref_pay_head_types')->insertGetId([
            'description' => 'Basic Salary',
            'company_id' => $companyId,
            'entry_user_id' => $userId,
            'entry_date' => now(),
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Seed Pay Heads
        $payHeadId = DB::table('ref_pay_heads')->insertGetId([
            'description' => 'Monthly Salary',
            'ref_pay_head_type_id' => $payHeadTypeId,
            'is_editable' => true,
            'company_id' => $companyId,
            'entry_user_id' => $userId,
            'entry_date' => now(),
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Seed Employee Salary Setup
        DB::table('employee_salary_setups')->insert([
            'emp_id' => $userId,
            'pay_head_id' => $payHeadId,
            'pay_head_type_id' => $payHeadTypeId,
            'amount' => 5000.00,
            'company_id' => $companyId,
            'entry_user_id' => $userId,
            'entry_date' => now(),
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
