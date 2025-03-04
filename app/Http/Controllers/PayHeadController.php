<?php

namespace App\Http\Controllers;


use App\Models\Company;
use App\Models\RefPayHead;
use App\Models\RefPayHeadType;
use App\Models\User;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PayHeadController extends Controller
{
    public function index()
    {
        $payHeads = RefPayHead::where("is_active", true)->get();
        $payHeadTypes = RefPayHeadType::where("is_active", true)->get();

        return view('pay-heads.index', compact('payHeads', 'payHeadTypes'));
    }

//    public function create(){}

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'payHeadTypeId' => 'required|integer|exists:ref_pay_head_types,id',
            'description' => 'required|string|max:50|regex:/^[a-zA-Z\s]+$/',
            'isEditable'=> "nullable|boolean"
        ]);

        // find the pay-head type
        $payHeadType = RefPayHeadType::where("is_active", true)->find($request->payHeadTypeId);

        if (!$payHeadType) return response()->json([
            'success' => false,
            'message' => 'Pay Head Type not found.'
        ], 404);

        $newPayHead = new RefPayHead();
        $newPayHead->description = $request->description;
        $newPayHead->payHeadType()->associate($payHeadType);
        $newPayHead->company()->associate(Company::findOrFail(1));
        $newPayHead->entryUser()->associate(User::findOrFail(auth()->id ?? 1));
        $newPayHead->save();


        // Load related data after creation
        $newPayHead->load('payHeadType')->load('company')->load('entryUser');

        return response()->json([
            'success' => true,
            'message' => 'Pay Head created successfully.',
            'data' => [$newPayHead]
        ]);
    }

    public function show(string $id): JsonResponse
    {
        $payHead = RefPayHead::where("is_active", true)->findOrFail($id);
        return response()->json([
            'success' => true,
            'data' => [$payHead]
        ]);
    }

//    public function edit(string $id){}

    public function update(Request $request, string $id):JsonResponse
    {
        $request->validate([
            'payHeadTypeId' => 'required|integer|exists:ref_pay_head_types,id',
            'description' => 'required|string|max:50|regex:/^[a-zA-Z\s]+$/',
        ]);

        $payHead = RefPayHead::where("is_active", true)->findOrFail($id);
        $payHeadType = RefPayHeadType::where("is_active", true)->find($request->payHeadTypeId);

        if (!$payHead || !$payHeadType) return response()->json([
            'success' => false,
            'message' => 'invalid request. "Pay Head" or "Pay Head Type" not found.'
        ], 404);

        $payHead->description = $request->description;
        $payHead->is_editable = (bool)$request->isEditable;
        $payHead->payHeadType()->associate($payHeadType);
        $payHead->save();

        return response()->json([
            'success' => true,
            'message' => '"Pay Head" updated successfully.',
            'data' => [$payHead]
        ]);
    }

    public function destroy(string $id)
    {
        $payHead = RefPayHead::where("is_active", true)->find($id);

        if (!$payHead) return response()->json([
            'success' => false,
            'message' => '"Pay Head" not found.'
        ], 404);

        $payHead->is_active = 0;
        $payHead->save();

        return response('', 200);
//        return response()->json([
//            'success' => true,
//            'message' => 'Pay Head deleted successfully.',
//            'data' => [$payHead],
//        ]);

    }
}
