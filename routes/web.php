<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\GoogleController;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/forgot-password', [PasswordResetController::class, 'showForgotPasswordForm'])
        ->name('password.request');
    Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLinkEmail'])
        ->name('password.email');
    Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetForm'])
        ->name('password.reset');
    Route::post('/reset-password', [PasswordResetController::class, 'resetPassword'])
        ->name('password.update');
});
Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

// Route::middleware('auth')->group(function () {

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

// Dashboard
// Route::get('/dashboard', function () {
//     return view('admin.dashboard');
// })->name('admin.dashboard');

// Users
Route::get('users', function () {
    return view('admin.users.index');
})->name('admin.users.index');

Route::get('users/{user}', function ($id) {
    return view('admin.users.show');
})->name('admin.users.show');

Route::get('users/{user}/edit', function ($id) {
    return view('admin.users.edit');
})->name('admin.users.edit');

// Services
Route::get('services', function () {
    return view('admin.services.index');
})->name('admin.services.index');

Route::get('services/{service}', function ($id) {
    return view('admin.services.show');
})->name('admin.services.show');

Route::get('services/{service}/edit', function ($id) {
    return view('admin.services.edit');
})->name('admin.services.edit');

// Categories
Route::get('categories', function () {
    return view('admin.categories.index');
})->name('admin.categories.index');

Route::get('categories/{category}/edit', function ($id) {
    return view('admin.categories.edit');
})->name('admin.categories.edit');

// Transactions
Route::get('transactions', function () {
    return view('admin.transactions.index');
})->name('admin.transactions.index');

// Settings
Route::get('settings', function () {
    return view('admin.settings.index');
})->name('admin.settings.index');

// Components
Route::get('components/verification-panel', function () {
    return view('admin.components.verification-panel');
})->name('admin.components.verification-panel');

Route::get('components/user-status-manager', function () {
    return view('admin.components.user-status-manager');
})->name('admin.components.user-status-manager');

// Partials
Route::get('partials/analytics', function () {
    return view('admin.partials._analytics');
})->name('admin.partials.analytics');

Route::get('partials/pending-services', function () {
    return view('admin.partials._pending-services');
})->name('admin.partials.pending-services');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// });

// Google login routes
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('login.google');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

// just views

// Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // // Dashboard
    // Route::get('/', function () {
    //     return view('admin.dashboard');
    // })->name('dashboard');
    
    // // Users
    // Route::get('users', function () {
    //     return view('admin.users.index');
    // })->name('users.index');
    
    // Route::get('users/{user}', function ($id) {
    //     return view('admin.users.show');
    // })->name('users.show');
    
    // Route::get('users/{user}/edit', function ($id) {
    //     return view('admin.users.edit');
    // })->name('users.edit');
    
    // // Services
    // Route::get('services', function () {
    //     return view('admin.services.index');
    // })->name('services.index');
    
    // Route::get('services/{service}', function ($id) {
    //     return view('admin.services.show');
    // })->name('services.show');
    
    // Route::get('services/{service}/edit', function ($id) {
    //     return view('admin.services.edit');
    // })->name('services.edit');
    
    // // Categories
    // Route::get('categories', function () {
    //     return view('admin.categories.index');
    // })->name('categories.index');
    
    // Route::get('categories/{category}/edit', function ($id) {
    //     return view('admin.categories.edit');
    // })->name('categories.edit');
    
    // // Transactions
    // Route::get('transactions', function () {
    //     return view('admin.transactions.index');
    // })->name('transactions.index');
    
    // // Settings
    // Route::get('settings', function () {
    //     return view('admin.settings.index');
    // })->name('settings.index');
    
    // // Components
    // Route::get('components/verification-panel', function () {
    //     return view('admin.components.verification-panel');
    // })->name('components.verification-panel');
    
    // Route::get('components/user-status-manager', function () {
    //     return view('admin.components.user-status-manager');
    // })->name('components.user-status-manager');
    
    // // Partials
    // Route::get('partials/analytics', function () {
    //     return view('admin.partials._analytics');
    // })->name('partials.analytics');
    
    // Route::get('partials/pending-services', function () {
    //     return view('admin.partials._pending-services');
    // })->name('partials.pending-services');
// });