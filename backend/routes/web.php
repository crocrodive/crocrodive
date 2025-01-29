<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;

// Route pour afficher la page d'accueil
Route::get('/', function () {
    return view('welcome');
});

// Route pour afficher le formulaire de connexion
Route::get('/login', [LoginController::class, 'create'])->name('login_get');

// Route pour ce connecter via le formulaire
Route::post('/login', [LoginController::class, 'store'])->name('login_post');

// Route to handle logout
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');


Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');
