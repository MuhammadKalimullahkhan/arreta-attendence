<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Department;
use App\Models\Designation;

class AttendanceController extends Controller
{
    public function  index ()
    {
        $attendances = Attendance::where("is_active", true)->get()->load('employee')->load('designation');
        $departments = Department::where("is_active", true)->get();
        $designations = Designation::where("is_active", true)->get();

        return view('attendance', compact('attendances', 'departments', 'designations'));
    }
}
