<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use App\Models\Department;
use App\Models\Designation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeaveController extends Controller
{
    public function index()
    {
        $currentDate = Carbon::today();
        $absentUsers = DB::select('CALL GetLeavesData(?,?,?,?)', [
            $currentDate, // Current date
            0, // Designation ID
            0, // Department ID
            auth()->user()->company_id ?? 1 // Company ID
        ]);

        $departments = Department::where("is_active", true)->get();
        $designations = Designation::where("is_active", true)->get();

        return view(
            'leave',
            compact(
                'absentUsers',
                'departments',
                'designations'
            )
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'leaves_id' => 'required|array', // Ensure it's an array
        ]);

        foreach ($request->leaves_id as $leaveId => $leaveType) {

            $leave = Leave::find($leaveId);
            $leave->update([
                'approval' => true,
                'approval_date' => now(),
                'entry_user_id' => auth()->user()->id,
                'is_without_pay' => $leaveType === 'casual' ? true : false, // Assuming 'casual' means unpaid leave
                'leave_type_id' => $leaveType === 'casual' ? 2 : 4, // 2: Casual leave, 4: Paid Leave (in leave_types table)
            ]);

        }

        return response()->json([
            'success' => true,
            'message' => 'Attendance marked successfully.'
        ]);
    }

    public function filterUsers(Request $request)
    {
        $currentDate = Carbon::today();

        // Query users who haven't given attendance today
        // $query = User::whereIn('id', function ($query) use ($currentDate) {
        //     $query->select('employee_id')->from('leaves')->whereDate('date', $currentDate)->where('is_present', false)->where('leave_type_id', null || 0);
        // })->where('is_active', true);

        // if ($request->department_id) {
        //     $query->where('department_id', $request->department_id);
        // }

        // if ($request->designation_id) {
        //     $query->where('designation_id', $request->designation_id);
        // }
        // $usersWithAttendance = $query->get();

        // GetLeavesData(CurrentDate, DesignationId, DepartmentId, CompanyId)
        $absentUsers = DB::select('CALL GetLeavesData(?,?,?,?)', [
            $currentDate,
            $request->designation_id ?? 0,
            $request->department_id ?? 0,
            auth()->user()->company_id ?? 1
        ]);

        return response()->json([
            'success' => true,
            "html" => view("partials.leave-table", compact("absentUsers"))->render(),
        ]);
    }
}
