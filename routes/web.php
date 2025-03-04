<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\PayHeadController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;

// dashboard
Route::get('/', function () {
    return view('dashboard');
});

Route::resource('/attendance', AttendanceController::class)->names('attendances');
Route::resource('/users', UserController::class)->names('users');
Route::resource("/departments", DepartmentController::class)->names("departments");
Route::resource("/designation", DesignationController::class)->names("designations");
Route::resource("/roles", RoleController::class)->names("roles");
Route::resource("/pay-heads", PayHeadController::class)->names("pay-heads");
