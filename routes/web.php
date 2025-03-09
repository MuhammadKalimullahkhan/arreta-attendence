<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LeaveController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PayHeadController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DepartmentController;


Route::group(['prefix' => '/'], function () {

    // Guest Routes
    Route::middleware(['guest'])->group(function () {
        // Authentication
        Route::prefix('/')->group(function () {
            Route::get('login', [LoginController::class, 'index'])->name('account.login');
            Route::post('authenticate', [LoginController::class, 'login'])->name('account.authenticate');
        });
    });

    // Authenticated Routes
    Route::middleware(['auth', 'role:admin'])->group(function () {
        // Authentication Logout
        Route::get('logout', [LoginController::class, 'logout'])->name('account.logout');

        // dashboard
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('/attendance', AttendanceController::class, ['only' => ['index', 'store']])->names('attendances');
        Route::get('/attendance2', [AttendanceController::class, 'attendance2'])->name('attendances.attendance2');
        Route::get('/attendance/filter-users', [AttendanceController::class, 'filterUsers'])->name('attendances.filterUsers');

        Route::resource('/leave', LeaveController::class, ['only' => ['index', 'store']])->names('leave');
        Route::get('/leave/filter-users', [LeaveController::class, 'filterUsers'])->name('leave.filterUsers');

        Route::resource('/users', UserController::class)->names('users');
        Route::resource('/departments', DepartmentController::class)->names('departments');
        Route::resource('/designation', DesignationController::class)->names('designations');
        Route::resource('/roles', RoleController::class)->names('roles');
        Route::resource('/pay-heads', PayHeadController::class)->names('pay-heads');
    });
});
