<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Provider\ProfileController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\RoleSelectionController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\CategoryStatisticsController;
use Illuminate\Support\Facades\App;

Route::get('/', function () {
    return view('homepage');
});

// Homepage route
Route::get('/homepage', function () {
    return view('homepage');
})->name('homepage');

Route::middleware('guest')->group(function () {
    // login
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    // Forgot Password 
    Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])
        ->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
        ->name('password.email');

    // Reset Password 
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])
        ->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])
        ->name('password.update');
});

Route::get('login/google', [GoogleController::class, 'redirectToGoogle'])->name('login.google');
Route::get('login/google/callback', [GoogleController::class, 'handleGoogleCallback']);

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Roles Management
    Route::resource('roles', RoleController::class);

    // Permissions Management
    Route::resource('permissions', PermissionController::class);

    Route::post('permissions/{permission}/assign-to-roles', [PermissionController::class, 'assignToRoles'])->name('permissions.assign-to-roles');

    Route::resource('users', UserController::class);

    Route::resource('categories', CategoryController::class);

    Route::resource('services', ServiceController::class);
    Route::post('services/{service}/change-status', [ServiceController::class, 'changeStatus'])->name('services.changeStatus');

    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::put('/profile', [UserController::class, 'updateProfile'])->name('profile.update');

    // Ban/unban routes
    Route::post('/users/{user}/ban', [UserController::class, 'ban'])->name('users.ban');
    Route::post('/users/{user}/unban', [UserController::class, 'unban'])->name('users.unban');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Role Selection Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/select-role', [RoleSelectionController::class, 'showRoleSelectionForm'])->name('role.selection');
    Route::post('/select-role', [RoleSelectionController::class, 'processRoleSelection'])->name('role.select');
    Route::get('/skip-role-selection', [RoleSelectionController::class, 'skipRoleSelection'])->name('role.skip');
});

// Provider Routes
Route::middleware(['auth', 'role:provider'])->prefix('provider')->name('provider.')->group(function () {
    Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::get('/next-steps', [ProfileController::class, 'showNextSteps'])->name('next-steps');

    // Service routes
    Route::get('/services/create', [\App\Http\Controllers\Provider\ServiceController::class, 'create'])->name('services.create');
    Route::post('/services', [\App\Http\Controllers\Provider\ServiceController::class, 'store'])->name('services.store');
});