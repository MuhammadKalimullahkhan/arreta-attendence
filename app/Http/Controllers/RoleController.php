<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $activeRoles = Role::where("is_active", true)->get();

        return view('roles', compact('activeRoles'));
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'description' => 'required|string|max:50|regex:/^[a-zA-Z\s]+$/',

        ]);

        $newRole = new Role();
        $newRole->description = $request->description;
        $newRole->company_id = 1;
        $newRole->entry_user_id = auth()->id ?? 1;
        $newRole->save();

        return response()->json([
            'success' => true,
            'message' => 'Role created successfully.',
            'data' => [$newRole]
        ]);
    }

    public function show(string $id): JsonResponse
    {
        $role = Role::where("is_active", true)->findOrFail($id);
        return response()->json([
            'success' => true,
            'data' => [$role]
        ]);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $request->validate([
            'description' => 'required|string|max:50|regex:/^[a-zA-Z\s]+$/',

        ]);

        $role = Role::where("is_active", true)->findOrFail($id);
        if (!$role)
            return response()->json([
                'success' => false,
                'message' => 'invalid request. "Role" not found.'
            ], 404);

        $role->description = $request->description;
        $role->save();

        return response()->json([
            'success' => true,
            'message' => '"Role" updated successfully.',
            'data' => [$role]
        ]);
    }

    public function destroy(string $id)
    {
        $payHead = Role::where("is_active", true)->find($id);

        if (!$payHead)
            return response()->json([
                'success' => false,
                'message' => '"Role" not found.'
            ], 404);

        $payHead->is_active = 0;
        $payHead->save();

        return response('', 200);
    }
}
