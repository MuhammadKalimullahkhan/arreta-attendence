<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;

// dashboard
Route::get('/', function () {
    return view('dashboard');
});

// Users
Route::get('/users', function () {
    return view('users');
});

// Roles
Route::get('/roles', function () {
    return view('roles');
});

// Payhead
Route::get('/payhead', function () {
    return view('payhead');
});

// Reports
Route::get('/reports', function () {
    return view('reports');
});

// Profile
Route::get('/profile', function () {
    return view('profile');
});

// Attendance
Route::get('attendance', function (){
    return view('attendance');
});

Route::get('designation', function (){
    return view('designation');
});
Route::get('leave', function (){
    return view('leave');
});

Route::prefix('/departments')->group(function (){
    Route::get('/', [DepartmentController::class, 'list'])->name('departments.list');;
    Route::post('/', [DepartmentController::class, 'create'])->name('departments.create');;
    Route::put('/{id}', [DepartmentController::class, 'edit'])->name('departments.edit');;
    Route::delete('/{id}', [DepartmentController::class, 'delete'])->name('departments.delete');;
});