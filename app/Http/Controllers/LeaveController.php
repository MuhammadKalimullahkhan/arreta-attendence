<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\User;
use App\Models\Department;
use App\Models\Designation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    public function index()
    {
        $currentDate = Carbon::today();

        // Fetch users who haven't marked attendance today
        $usersWithAttendance = User::whereIn('id', function ($query) use ($currentDate) {
            $query->select('employee_id')->from('attendances')->whereDate('date', $currentDate)->where('is_present', false)->where('leave_type_id', null || 0);
        })->where('is_active', true)->get();

        $departments = Department::where("is_active", true)->get();
        $designations = Designation::where("is_active", true)->get();

        return view('leave', compact('usersWithAttendance', 'departments', 'designations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employees' => 'required|array', // Ensure it's an array
        ]);

        foreach ($request->employees as $employeeId => $leaveType) {
            $user = User::find($employeeId); // Retrieve user to get designation & department
            $attendance = Attendance::where('employee_id', $user->id)
                ->whereDate('date', now()->toDateString())
                ->firstOrFail();

            $attendance->update([
                'leave_type_id' => $leaveType === 'casual' ? 2 : 4, // 2: Casual leave, 4: Paid Leave (in leave_types table)
                'is_present' => false,
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
        $query = User::whereIn('id', function ($query) use ($currentDate) {
            $query->select('employee_id')->from('attendances')->whereDate('date', $currentDate)->where('is_present', false)->where('leave_type_id', null || 0);
        })->where('is_active', true);

        if ($request->department_id) {
            $query->where('department_id', $request->department_id);
        }

        if ($request->designation_id) {
            $query->where('designation_id', $request->designation_id);
        }

        $usersWithAttendance = $query->get();

        return response()->json([
            'success' => true,
            "html" => view("partials.leave-table", compact("usersWithAttendance"))->render(),
        ]);
    }
}
