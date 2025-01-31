<?php

use App\Http\Controllers\Api\ApiUserController;
use App\Http\Middleware\EnsureConnected;
use App\Http\Middleware\EnsureGuest;
use App\Http\Middleware\EnsureTechnicalDirector;
use App\Http\Middleware\EnsureRoles;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CreateUserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ManageController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\PlanningController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Enum\Roles;
use App\Http\Controllers\Sessions;


function getEnsureRolesMiddleware($roles) {
    return ['ensure.roles:'.implode(',',$roles)];
}

// Guest
Route::middleware([EnsureGuest::class])->group(function () {
    Route::redirect('/', '/login')->name('home');

    // Route to display the login form.
    Route::get('/login', [LoginController::class, 'create'])->name('login_get');

    // Route to handle the form submission.
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login_post');;
});


// Connected user.
Route::middleware([EnsureConnected::class])->group(function () {
    Route::redirect('/', '/dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Route to handle logout
    Route::get('/logout', [LoginController::class, 'destroy'])->name('logout_get');
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
});

// Responsable  de Formation
Route::middleware(getEnsureRolesMiddleware([Roles::COURSE_MANAGER->name]))->group(function () {
    Route::get('/sessions', [Sessions::class, 'index'])->name('sessions');
});

// Technical director
Route::middleware([EnsureTechnicalDirector::class])->group(function () {
    Route::get('/manage', [ManageController::class, 'index'])->name('manage');
    Route::post('/manage', [ManageController::class, 'create'])->name('manage_post');

    Route::get('/formation', [FormationController::class, 'index'])
        ->name('formation');

    Route::get('/skills', function() { return View::make("skills");})->name('skills');

    Route::get('/api/locations', [FormationController::class, 'getLocations'])
    ->name('api.location');

    Route::get('/api/trainers', [FormationController::class, 'getInstructorData'])
    ->name('api.trainer');

    Route::get('/api/levels', [FormationController::class, 'getLevels'])
    ->name('api.levels');

    Route::get('/api/participants', [FormationController::class, 'getParticipantData'])
    ->name('api.participants');

    Route::post('/api/courses', [FormationController::class, 'store'])
    ->name('api.courses');

    Route::get('/course/{id}', [FormationController::class, 'show'])
    ->name('course.show');
});

// Planning (Attendee, Instructor, Course manager)
Route::middleware(getEnsureRolesMiddleware([Roles::ATTENDEE->name, Roles::INSTRUCTOR->name, Roles::COURSE_MANAGER->name]))->group(function () {
    Route::get('/planning', [PlanningController::class, 'index'])->name('planning');
});


// Directeur technique
Route::middleware([EnsureTechnicalDirector::class])->group(function () {
    Route::get('/users', [CreateUserController::class, 'index'])->name('create_user');
    Route::post('/create_user', [CreateUserController::class, 'create'])->name('add_user');
    Route::post('/edit_user/{id}', [CreateUserController::class, 'edit'])->name('update_user');
    Route::post('/user/{id}', [CreateUserController::class, 'deleteUser'])->name('delete_user');
});

Route::post('/api/login', [ApiUserController::class, 'login']);


