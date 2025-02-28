<?php

namespace App\Http\Controllers;


use App\Models\Department;
use App\Models\Designation;
use App\Models\LeaveType;
use App\Models\RefPayHead;
use App\Models\RefPayHeadType;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
//        $request->validate([
//            'description' => 'required|string|max:255',
//        ]);

        return $request;
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
        $request->validate([
            'description' => 'required|string|max:255',
        ]);

        $department = User::where("is_active", true)->findOrFail($id);
        if (!$department) return response()->json([
            'success' => false,
            'message' => 'invalid request. User not found.'
        ], 404);

        $department->description = $request->description;
        $department->save();

        return response()->json([
            'success' => true,
            'message' => 'User updated successfully.',
            'data' => [$department]
        ]);
    }

    public function destroy(string $id)
    {
        $payHead = User::where("is_active", true)->find($id);

        if (!$payHead) return response()->json([
            'success' => false,
            'message' => 'User not found.'
        ], 404);

        $payHead->is_active = 0;
        $payHead->save();

        return response('', 200);
    }
}
