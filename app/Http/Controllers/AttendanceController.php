<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Leave;
use App\Models\User;
use App\Models\Department;
use App\Models\Designation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $currentDate = Carbon::today();

        // Fetch users who haven't marked attendance today
        $usersWithoutAttendance = User::whereNotIn('id', function ($query) use ($currentDate) {
            $query->select('employee_id')->from('attendances')->whereDate('date', $currentDate);
        })->where('is_active', true)->get();

        $departments = Department::where("is_active", true)->get();
        $designations = Designation::where("is_active", true)->get();

        return view('attendance', compact('usersWithoutAttendance', 'departments', 'designations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employees' => 'required|array', // Ensure it's an array
        ]);

        foreach ($request->employees as $employeeId => $status) {
            $user = User::find($employeeId); // Retrieve user to get designation & department

            $newUser = Attendance::create([
                'employee_id' => $user->id,
                'designation_id' => $user->designation_id ?? null, // Get designation from user
                'year_id' => now()->year,
                'month_id' => now()->month,
                'date' => now()->toDateString(),
                'leave_type_id' => 0, // no leave type
                'is_present' => $status === 'present', // Convert to boolean
                'company_id' => $user->company_id,
                'entry_user_id' => auth()->id() ?? 1,
                'entry_date' => now(),
                'is_active' => true,
            ]);

            if ($newUser->is_present == false) {
                Leave::create([
                    'employee_id' => $user->id,
                    'designation_id' => $user->designation_id ?? null,
                    'leave_type_id' => 2, // 2: Casual Leave (in leave_types table)
                    'from_date' => now()->toDateString(),
                    'number_of_days' => 1,
                    'approval' => 0, // 0: Not Approved
                    'approval_date' => null,
                    'paid_leave' => false, // Assuming this is a unpaid leave
                    'company_id' => $user->company_id ?? 1,
                    'entry_user_id' => auth()->id(),
                    'entry_date' => now(),
                    'is_active' => true,
                ]);
            }

        }

        return response()->json([
            'success' => true,
            'message' => 'Attendance marked successfully.'
        ]);
    }



    public function show($id)
    {
    }
    public function update(Request $request)
    {
    }

    public function destroy($id)
    {
    }

    public function filterUsers(Request $request)
    {
        $currentDate = Carbon::today();

        // Query users who haven't given attendance today
        $query = User::whereNotIn('id', function ($query) use ($currentDate) {
            $query->select('employee_id')->from('attendances')->whereDate('date', $currentDate);
        })->where('is_active', true);

        if ($request->department_id) {
            $query->where('department_id', $request->department_id);
        }

        if ($request->designation_id) {
            $query->where('designation_id', $request->designation_id);
        }

        $usersWithoutAttendance = $query->get();

        return response()->json([
            'success' => true,
            "html" => view("partials.attendance-table", compact("usersWithoutAttendance"))->render(),
        ]);
    }
}
