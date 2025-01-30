<?php

use App\Http\Middleware\EnsureConnected;
use App\Http\Middleware\EnsureGuest;
use App\Http\Middleware\EnsureTechnicalDirector;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CreateUserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;

// Utilisateur non connecté
Route::middleware([EnsureGuest::class])->group(function () {
    Route::redirect('/', '/login')->name('home');

    // Route pour afficher le formulaire de connexion
    Route::get('/login', [LoginController::class, 'create'])->name('login_get');

    // Route pour ce connecter via le formulaire
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login_post');;
});

//Route pour créer un utilisateur

// Utilisateur connecté
Route::middleware([EnsureConnected::class])->group(function () {
    Route::redirect('/', '/dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Route to handle logout
    Route::get('/logout', [LoginController::class, 'destroy'])->name('logout_get');
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
});

// Directeur technique
Route::middleware([EnsureTechnicalDirector::class])->group(function () {
    Route::get('/create_user', [CreateUserController::class, 'index'])->name('add_user');
    Route::post('/create_user', [CreateUserController::class, 'create'])->name('create_user');
});

