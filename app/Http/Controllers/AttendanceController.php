<?php

namespace App\Http\Controllers;

use App\Models\Attendance;

class AttendanceController extends Controller
{
    public function  index ()
    {
        $attendances = Attendance::where("is_active", true)->get()->load('employee')->load('designation');

        return view('attendance', compact('attendances'));
    }
}
