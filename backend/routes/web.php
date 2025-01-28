<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/login', [LoginController::class, 'store'])->name('login');
Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');


Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');
