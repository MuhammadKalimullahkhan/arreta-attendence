<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Designation;
use App\Models\EmployeeSalarySetup;
use App\Models\Leave;
use App\Models\LeaveType;
use App\Models\RefPayHead;
use App\Models\RefPayHeadType;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $roles = Role::where("is_active", true)->get();
        $departments = Department::where("is_active", true)->get();
        $designations = Designation::where("is_active", true)->get();

        $payHeads = RefPayHead::where("is_active", true)->get();
        $headTypes = RefPayHeadType::where("is_active", true)->get();
        $leaveTypes = LeaveType::where("is_active", true)->get();

        $users = User::where("is_active", true)->get();
        $users = $users->load('designation')->load('role');

        return view(
            'users',
            compact(
                'users',
                'departments',
                'roles',
                'designations',
                'payHeads',
                'headTypes',
                'leaveTypes'
            )
        );
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $validator = $request->validate([
            // Validate the initialInfo object
            'initialInfo.name' => 'required|string',
            'initialInfo.cnic' => 'required|digits:13', // CNIC should be 13 digits
            'initialInfo.contact' => 'required|digits:11', // Assuming the contact is a 11-digit number
            'initialInfo.department' => 'required|integer|exists:departments,id',
            'initialInfo.role' => 'required|integer|exists:roles,id',
            'initialInfo.designation' => 'required|integer|exists:designations,id',

            // Validate the leave array
            'payrollSetup' => 'required|array',
            'payrollSetup.*.payHead' => 'required|integer|exists:ref_pay_heads,id',
            'payrollSetup.*.headType' => 'required|integer|exists:ref_pay_head_types,id',
            'payrollSetup.*.amount' => 'required|numeric',

            // Validate the leaveQuota array
            'leaveQuota' => 'required|array',
            'leaveQuota.*.leaveType' => 'required|integer|exists:leave_types,id',
            'leaveQuota.*.days' => 'required|integer',
        ]);

        DB::beginTransaction();

        // Create User
        $user = User::create([
            'name' => $request->initialInfo['name'], // Change here to use array syntax
            'cnic' => $request->initialInfo['cnic'], // Change here to use array syntax
            'contact' => $request->initialInfo['contact'], // Change here to use array syntax
            'department_id' => $request->initialInfo['department'], // Change here to use array syntax
            'role_id' => $request->initialInfo['role'], // Change here to use array syntax
            'designation_id' => $request->initialInfo['designation'], // Change here to use array syntax
            'company_id' => 1,
            'entry_user_id' => auth()->id() ?? 1,
        ]);

        // Create Employee Salary Setup
        foreach ($request->payrollSetup as $payroll) {
            EmployeeSalarySetup::create([
                'emp_id' => $user->id,
                'pay_head_id' => $payroll["payHead"],
                'pay_head_type_id' => $payroll["headType"],
                'amount' => $payroll["amount"],
                'company_id' => 1,
                'entry_user_id' => auth()->id() ?? 1,
            ]);
        }

        // Create Leaves
        foreach ($request->leaveQuota as $leave) {
            Leave::create([
                'employee_id' => $user->id,
                'designation_id' => $user->designation_id,
                'number_of_days' => $leave["days"],
                'leave_type_id' => $leave["leaveType"],
                'company_id' => 1,
                'entry_user_id' => auth()->id() ?? 1,
            ]);
        }

        DB::commit();

        return response()->json([
            'success' => true,
            "message" => "User created successfully",
        ]);
    }


    public function show(string $id): JsonResponse
    {
        $role = User::where("is_active", true)
            ->findOrFail($id)
            ->load('role')
            ->load('designation')
            ->load('department');

        return response()->json([
            'success' => true,
            'data' => [$role]
        ]);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        // Validate the incoming request
        $validator = $request->validate([
            // Validate the initialInfo object
            'initialInfo.name' => 'required|string',
            'initialInfo.cnic' => 'required|digits:13', // CNIC should be 13 digits
            'initialInfo.contact' => 'required|digits:11', // Assuming the contact is a 11-digit number
            'initialInfo.department' => 'required|integer|exists:departments,id',
            'initialInfo.role' => 'required|integer|exists:roles,id',
            'initialInfo.designation' => 'required|integer|exists:designations,id',

            // Validate the leave array
            'payrollSetup' => 'required|array',
            'payrollSetup.*.payHead' => 'required|integer|exists:ref_pay_heads,id',
            'payrollSetup.*.headType' => 'required|integer|exists:ref_pay_head_types,id',
            'payrollSetup.*.amount' => 'required|numeric',

            // Validate the leaveQuota array
            'leaveQuota' => 'required|array',
            'leaveQuota.*.leaveType' => 'required|integer|exists:leave_types,id',
            'leaveQuota.*.days' => 'required|integer',
        ]);

        DB::beginTransaction();

        try {
            // Find the user and update
            $user = User::findOrFail($id);
            $user->update([
                'name' => $request->initialInfo['name'],
                'cnic' => $request->initialInfo['cnic'],
                'contact' => $request->initialInfo['contact'],
                'department_id' => $request->initialInfo['department'],
                'role_id' => $request->initialInfo['role'],
                'designation_id' => $request->initialInfo['designation'],
                'company_id' => 1,
                'entry_user_id' => auth()->id() ?? 1,
            ]);

            // Update or insert Employee Salary Setup
            foreach ($request->payrollSetup as $payroll) {
                EmployeeSalarySetup::updateOrCreate(
                    [
                        'emp_id' => $user->id,
                        'pay_head_id' => $payroll["payHead"],
                    ],
                    [
                        'pay_head_type_id' => $payroll["headType"],
                        'amount' => $payroll["amount"],
                        'company_id' => 1,
                        'entry_user_id' => auth()->id() ?? 1,
                    ]
                );
            }

            // Update or insert Leave Quota
            foreach ($request->leaveQuota as $leave) {
                Leave::updateOrCreate(
                    [
                        'employee_id' => $user->id,
                        'leave_type_id' => $leave["leaveType"],
                    ],
                    [
                        'designation_id' => $user->designation_id,
                        'number_of_days' => $leave["days"],
                        'company_id' => 1,
                        'entry_user_id' => auth()->id() ?? 1,
                    ]
                );
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'User updated successfully',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy(string $id)
    {
//        $user = User::where("is_active", true)->find($id);
//
//        if (!$user) return response()->json([
//            'success' => false,
//            'message' => 'User not found.'
//        ], 404);
//
//        $user->is_active = 0;
//        $user->save();

        User::findOrFail($id)->delete();

        return response('', 200);
    }
}
