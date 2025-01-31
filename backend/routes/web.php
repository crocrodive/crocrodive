<?php

use App\Http\Controllers\Api\ApiUserController;
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
    Route::get('/users', [CreateUserController::class, 'index'])->name('create_user');
    Route::post('/create_user', [CreateUserController::class, 'create'])->name('add_user');
    Route::post('/edit_user/{id}', [CreateUserController::class, 'edit'])->name('update_user');
    Route::post('/user/{id}', [CreateUserController::class, 'deleteUser'])->name('delete_user');
});

Route::post('/api/login', [ApiUserController::class, 'login']);
