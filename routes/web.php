<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('attendance', function (){
    return view('attendance');
})->name('user');