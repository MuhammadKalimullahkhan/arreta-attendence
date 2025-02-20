<?php

use Illuminate\Support\Facades\Route;
// dashboard
Route::get('/', function () {
    return view('dashboard');
});

// Departments
Route::get('/departments', function () {
    return view('departments');
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