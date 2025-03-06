<?php

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
        Route::get('/', function () {
            return view('dashboard');
        });

        Route::get('/attendance/filter-users', [AttendanceController::class, 'filterUsers'])->name('attendances.filterUsers');
        Route::resource('/attendance', AttendanceController::class)->names('attendances');

        Route::resource('/users', UserController::class)->names('users');
        Route::resource('/departments', DepartmentController::class)->names('departments');
        Route::resource('/designation', DesignationController::class)->names('designations');
        Route::resource('/roles', RoleController::class)->names('roles');
        Route::resource('/pay-heads', PayHeadController::class)->names('pay-heads');
    });
});
