<?php

namespace App\Http\Controllers;

use App\Models\Department;
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
        $users = User::all();
        $departments = Department::where('is_active', true)->get();
        return view('payroll', compact('users', 'departments'));
    }

    public function store(Request $request)
    {

        // TODO: filtering is not working correctly.

        // Validate request data
        $request->validate([
            'user_id' => 'required|integer',
            'department_id' => 'required|integer',
            'company_id' => 'nullable|integer',
        ]);

        // Get request data safely and cast to integer
        $userId = (int) $request->input('user_id');
        $departmentId = (int) $request->input('department_id');
        $companyId = (int) ($request->input('company_id', 1)); // Default to 1 if null

        // Debugging to check values before executing query
        // dd("userId" . $userId, "dpt" . $departmentId, "companyId" . $companyId);

        // Corrected query
        $salaryData = DB::select("CALL GetPayrollSetupData(?, ?, ?, ?, ?)", [$userId, $departmentId, $companyId, $request->year, $request->month]);

        // Transform data for table display
        $payrolls = collect($salaryData)->values();

        // Return the response
        return response()->json([
            'success' => true,
            'data' => [$payrolls]
        ]);
    }


}
