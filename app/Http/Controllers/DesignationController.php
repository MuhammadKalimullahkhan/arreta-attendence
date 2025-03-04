<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    public function index()
    {
        $activeDesignation = Designation::where("is_active", true)->get();

        return view('designation', compact('activeDesignation'));
    }

    public function store(Request $request): JsonResponse
      {
        $request->validate([

            'description' => ['required', 'string', 'max:20', 'regex:/^[A-Za-z\s]+$/'],
      ]);



        $newDesignation = new Designation();
        $newDesignation->description = $request->description;
        $newDesignation->company_id = 1;
        $newDesignation->entry_user_id = auth()->id ?? 1;
        $newDesignation->save();

        return response()->json([
            'success' => true,
            'message' => '"Designation" created successfully.',
            'data' => [$newDesignation]
        ]);
    }

    public function show(string $id): JsonResponse
    {
        $role = Designation::where("is_active", true)->findOrFail($id);
        return response()->json([
            'success' => true,
            'data' => [$role]
        ]);
    }

    public function update(Request $request, string $id):JsonResponse
    {
        $request->validate([
            'description' => ['required', 'string', 'max:20', 'regex:/^[A-Za-z\s]+$/'],

        ]);

        $role = Designation::where("is_active", true)->findOrFail($id);
        if (!$role) return response()->json([
            'success' => false,
            'message' => 'invalid request. "Designation" not found.'
        ], 404);

        $role->description = $request->description;
        $role->save();

        return response()->json([
            'success' => true,
            'message' => '"Designation" updated successfully.',
            'data' => [$role]
        ]);
    }

    public function destroy(string $id)
    {
        $payHead = Designation::where("is_active", true)->find($id);

        if (!$payHead) return response()->json([
            'success' => false,
            'message' => '"Designation" not found.'
        ], 404);

        $payHead->is_active = 0;
        $payHead->save();

        return response('', 200);
    }
}
