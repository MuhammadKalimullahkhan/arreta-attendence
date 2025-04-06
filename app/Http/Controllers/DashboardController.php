<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Leave;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    private function selectAttendance($isPresent)
    {
        $today = Carbon::today();

        return DB::table('attendances')
            ->selectRaw('DAY(date) as day, COUNT(DISTINCT employee_id) as count')
            ->whereMonth('date', $today->month)
            ->whereYear('date', $today->year)
            ->where('is_present', $isPresent)
            ->groupBy('day')
            ->pluck('count', 'day')
            ->toArray();
    }


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

        $absentUsers = User::whereIn('id', function ($query) {
            $query->select('employee_id')->from('leaves')->whereDate('created_at', Carbon::today());
        })->get();


        // chart data
        $today = Carbon::today();
        $daysInMonth = $today->daysInMonth;
        $daysOfMonth = range(1, $daysInMonth); // [1, 2, ..., 30/31]

        // Attendance per day
        $attendance = $this->selectAttendance(true);

        $absenties = $this->selectAttendance(false);

        $dailyAttendanceCounts = array_map(fn($d) => $attendance[$d] ?? 0, $daysOfMonth);
        $dailyAbsentCounts = array_map(fn($d) => $absenties[$d] ?? 0, $daysOfMonth);

        return view('dashboard', compact(
            'daysOfMonth',
            'dailyAttendanceCounts',
            'dailyAbsentCounts',


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
