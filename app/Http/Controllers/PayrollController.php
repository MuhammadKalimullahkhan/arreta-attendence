<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payrolls = User::with(['designation', 'salarySetups.payHead'])
            ->whereHas('salarySetups') // Ensure employees have salary data
            ->get()
            ->map(function ($user) {
                return [
                    'is_hold' => false, // Placeholder if you have an "on hold" status
                    'employee' => $user->name,
                    'designation' => optional($user->designation)->description,
                    'joining_date' => Carbon::parse($user->entry_date)->format('Y-m-d'),
                    'status' => $user->is_active ? 'Active' : 'Inactive',
                    'basic_salary' => $user->salarySetups->where('payHead.description', 'Basic Salary')->sum('amount'),
                    'medical' => $user->salarySetups->where('payHead.description', 'Medical')->sum('amount'),
                    'house_rent' => $user->salarySetups->where('payHead.description', 'House Rent')->sum('amount'),
                    'total_gross_salary' => $user->salarySetups
                        ->whereIn('payHead.description', ['Basic Salary', 'Medical', 'House Rent'])
                        ->sum('amount'),
                    'monthly_commission' => $user->salarySetups->where('payHead.description', 'Monthly Commission')->sum('amount'),
                    'total_variable_earning' => $user->salarySetups
                        ->whereNotIn('payHead.description', ['Basic Salary', 'Medical', 'House Rent'])
                        ->sum('amount'),
                    'total_gross' => $user->salarySetups->sum('amount'),
                ];
            });

        return view('payroll', compact('payrolls'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
