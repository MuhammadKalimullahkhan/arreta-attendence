<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::where("is_active", true)->get();

        return view('departments', compact('departments'));
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'description' => 'required|string|max:50|min:1|regex:/^[A-Za-z\s]+$/',
        ]);

        $department = new Department();
        $department->description = $request->description;
        $department->company_id = 1;
        $department->entry_user_id = auth()->id ?? 1;
        $department->save();

        return response()->json([
            'success' => true,
            'message' => 'Department created successfully.',
            'data' => [$department]
        ]);
    }

    public function show(string $id): JsonResponse
    {
        $role = Department::where("is_active", true)->findOrFail($id);
        return response()->json([
            'success' => true,
            'data' => [$role]
        ]);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $request->validate([
            'description' => 'required|string|max:50|min:1|regex:/^[A-Za-z\s]+$/',

        ]);

        $department = Department::where("is_active", true)->findOrFail($id);
        if (!$department) return response()->json([
            'success' => false,
            'message' => 'invalid request. Department not found.'
        ], 404);

        $department->description = $request->description;
        $department->save();

        return response()->json([
            'success' => true,
            'message' => 'Department updated successfully.',
            'data' => [$department]
        ]);
    }

    public function destroy(string $id)
    {
        $payHead = Department::where("is_active", true)->find($id);

        if (!$payHead) return response()->json([
            'success' => false,
            'message' => 'Department not found.'
        ], 404);

        $payHead->is_active = 0;
        $payHead->save();

        return response('', 200);
    }
}
