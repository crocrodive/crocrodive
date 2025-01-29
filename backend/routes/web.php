<?php

use App\Http\Middleware\EnsureConnected;
use App\Http\Middleware\EnsureGuest;
use App\Http\Middleware\EnsureTechnicalDirector;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

// Utilisateur non connecté
Route::middleware([EnsureGuest::class])->group(function () {
    Route::redirect('/', '/login');

    // Route pour afficher le formulaire de connexion
    Route::get('/login', [LoginController::class, 'create'])->name('login_get');

    // Route pour ce connecter via le formulaire
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login_post');;
});

// Utilisateur connecté
Route::middleware([EnsureConnected::class])->group(function () {
    Route::redirect('/', '/dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Route to handle logout
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
    Route::get('/logout', [LoginController::class, 'destroy'])->name('logout');
});

// Directeur technique
Route::middleware([EnsureTechnicalDirector::class])->group(function () {
    Route::get('register', [RegisterController::class, 'create'])->name('register');
    Route::post('register', [RegisterController::class, 'store']);
});

