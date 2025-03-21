<?php

namespace App\Http\Controllers;


use App\Models\User;


class EmployeeController extends Controller
{
    public function index()
    {
        $employees = User::with([
            'designation',
            'payrollSetup.payHead',
            'payrollSetup.payHeadType'
        ])->get();

        return view("employee.info", compact("employees"));
    }

    public function dashboard()
    {
        return view("employee.dashboard");
    }
}
