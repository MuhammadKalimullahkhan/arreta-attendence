<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Leave;
use Carbon\Carbon;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $currentMonthEmployees = User::where('is_active', true)->count();
        $lastMonthEmployees = User::where('is_active', true)
            ->whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->count();
        $employeeChange = $lastMonthEmployees > 0 ? (($currentMonthEmployees - $lastMonthEmployees) / $lastMonthEmployees) * 100 : 100;

        $todayAttendance = Attendance::whereDate('date', Carbon::today())->where('is_present', true)->count();
        $yesterdayAttendance = Attendance::whereDate('date', Carbon::yesterday())->where('is_present', true)->count();
        $attendanceChange = $yesterdayAttendance > 0 ? (($todayAttendance - $yesterdayAttendance) / $yesterdayAttendance) * 100 : 100;

        $todayPaidLeave = Leave::whereDate('from_date', Carbon::today())->where('is_without_pay', false)->count();
        $yesterdayPaidLeave = Leave::whereDate('from_date', Carbon::yesterday())->where('is_without_pay', false)->count();
        $paidLeaveChange = $yesterdayPaidLeave > 0 ? (($todayPaidLeave - $yesterdayPaidLeave) / $yesterdayPaidLeave) * 100 : 100;

        $absentUsers = User::whereNotIn('id', function ($query) {
            $query->select('employee_id')->from('attendances')->whereDate('date', Carbon::today());
        })->get();

        return view('dashboard', compact(
            'currentMonthEmployees',
            'lastMonthEmployees',
            'employeeChange',
            'todayAttendance',
            'yesterdayAttendance',
            'attendanceChange',
            'todayPaidLeave',
            'yesterdayPaidLeave',
            'paidLeaveChange',
            'absentUsers'
        ));
    }

}
