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
use App\Http\Controllers\Provider\ProfileController as ProviderProfileController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\RoleSelectionController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\CategoryStatisticsController;
use App\Http\Controllers\Admin\GamificationController;
use App\Http\Controllers\Client\BookingController as ClientBookingController;
use App\Http\Controllers\Client\RatingController as ClientRatingController;
use App\Http\Controllers\Provider\BookingController as ProviderBookingController;
use App\Http\Controllers\Provider\RatingController as ProviderRatingController;
use App\Http\Controllers\Provider\AvailabilityController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserGamificationController;
use Illuminate\Support\Facades\App;

Route::get('/', function () {
    // Get repository and service instances
    $categoryRepository = app(\App\Repositories\Interfaces\CategoryRepositoryInterface::class);
    $serviceRepository = app(\App\Repositories\Interfaces\ServiceRepositoryInterface::class);
    $userRepository = app(\App\Repositories\Interfaces\UserRepositoryInterface::class);
    
    // Get categories for the homepage
    $categories = $categoryRepository->getAllCategories();
    $featuredCategories = $categoryRepository->getMainCategories()->take(6);
    
    // Get services for the homepage
    $services = $serviceRepository->getActiveServices()->take(8);
    
    // Get providers (users with provider role)
    $providers = $userRepository->getUsersByRole('provider')->take(4);
    
    return view('homepage', compact('categories', 'featuredCategories', 'services', 'providers'));
})->name('home');

// Homepage route
Route::get('/homepage', function () {
    return redirect()->route('home');
})->name('homepage');

// Services routes
Route::get('/services', function () {
    // Get repository instances
    $categoryRepository = app(\App\Repositories\Interfaces\CategoryRepositoryInterface::class);
    $serviceRepository = app(\App\Repositories\Interfaces\ServiceRepositoryInterface::class);
    
    // Get all active services
    $services = $serviceRepository->getActiveServices();
    
    // Get all categories for filtering
    $categories = $categoryRepository->getAllCategories();
    
    return view('services.index', compact('services', 'categories'));
})->name('services.index');

// All categories route
Route::get('/categories', function () {
    // Get repository instances
    $categoryRepository = app(\App\Repositories\Interfaces\CategoryRepositoryInterface::class);
    $serviceRepository = app(\App\Repositories\Interfaces\ServiceRepositoryInterface::class);
    
    // Get all categories with service counts
    $categories = $categoryRepository->getAllCategories();
    
    // Filter categories with service count > 0 and sort them
    $sortedCategories = $categories->filter(function($category) {
        $count = \App\Models\Service::where('category_id', $category->id)
            ->where('status', 'active')
            ->count();
        return $count > 0;
    })->sortByDesc(function($category) {
        return \App\Models\Service::where('category_id', $category->id)
            ->where('status', 'active')
            ->count();
    });
    
    return view('categories.index', compact('sortedCategories'));
})->name('categories.index');

// Category services route
Route::get('/categories/{category}/services', function ($categoryId) {
    // Get repository instances
    $categoryRepository = app(\App\Repositories\Interfaces\CategoryRepositoryInterface::class);
    $serviceRepository = app(\App\Repositories\Interfaces\ServiceRepositoryInterface::class);
    
    // Get category and its services
    $category = $categoryRepository->getCategoryById($categoryId);
    $services = $serviceRepository->getServicesByCategory($categoryId);
    
    if (!$category) {
        abort(404);
    }
    
    return view('categories.services', compact('category', 'services'));
})->name('categories.services');

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
    
    // Gamification management
    Route::get('/gamification', [GamificationController::class, 'index'])->name('gamification.index');
    Route::get('/gamification/badges', [GamificationController::class, 'badges'])->name('gamification.badges');
    Route::get('/gamification/badges/create', [GamificationController::class, 'createBadge'])->name('gamification.badges.create');
    Route::post('/gamification/badges', [GamificationController::class, 'storeBadge'])->name('gamification.badges.store');
    Route::get('/gamification/badges/{badge}/edit', [GamificationController::class, 'editBadge'])->name('gamification.badges.edit');
    Route::put('/gamification/badges/{badge}', [GamificationController::class, 'updateBadge'])->name('gamification.badges.update');
    Route::delete('/gamification/badges/{badge}', [GamificationController::class, 'destroyBadge'])->name('gamification.badges.destroy');
    Route::get('/gamification/badges/{badge}/users', [GamificationController::class, 'badgeUsers'])->name('gamification.badges.users');
    Route::post('/gamification/award-badge', [GamificationController::class, 'awardBadge'])->name('gamification.award-badge');
    Route::post('/gamification/award-points', [GamificationController::class, 'awardPoints'])->name('gamification.award-points');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Role Selection Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/select-role', [RoleSelectionController::class, 'showRoleSelectionForm'])->name('role.selection');
    Route::post('/select-role', [RoleSelectionController::class, 'processRoleSelection'])->name('role.select');
    Route::get('/skip-role-selection', [RoleSelectionController::class, 'skipRoleSelection'])->name('role.skip');
    
    // Gamification Routes (for all authenticated users)
    Route::get('/gamification', [UserGamificationController::class, 'index'])->name('gamification.profile');
    Route::get('/gamification/badges', [UserGamificationController::class, 'badges'])->name('gamification.user-badges');
    Route::get('/gamification/leaderboard', [UserGamificationController::class, 'leaderboard'])->name('gamification.leaderboard');
    
    // Messaging Routes (for all authenticated users)
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/create', [MessageController::class, 'create'])->name('messages.create');
    Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');
    Route::get('/messages/{user}', [MessageController::class, 'conversation'])->name('messages.conversation');
    Route::post('/messages/send', [MessageController::class, 'send'])->name('messages.send');
    Route::delete('/messages/{user}', [MessageController::class, 'delete'])->name('messages.delete');
    Route::get('/messages/unread/count', [MessageController::class, 'getUnreadCount'])->name('messages.unread-count');
});

// Client Routes
Route::middleware(['auth', 'role:client'])->prefix('client')->name('client.')->group(function () {
    // Booking Routes
    Route::get('/bookings', [ClientBookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/create', [ClientBookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings', [ClientBookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings/{booking}/confirmation', [ClientBookingController::class, 'confirmation'])->name('bookings.confirmation');
    Route::get('/bookings/{booking}', [ClientBookingController::class, 'show'])->name('bookings.show');
    Route::post('/bookings/{booking}/cancel', [ClientBookingController::class, 'cancel'])->name('bookings.cancel');
    Route::get('/bookings/get-time-slots', [ClientBookingController::class, 'getTimeSlots'])->name('bookings.get-time-slots');
    
    // Rating Routes
    Route::get('/ratings', [ClientRatingController::class, 'index'])->name('ratings.index');
    Route::get('/ratings/create', [ClientRatingController::class, 'create'])->name('ratings.create');
    Route::post('/ratings', [ClientRatingController::class, 'store'])->name('ratings.store');
    Route::get('/ratings/{rating}/edit', [ClientRatingController::class, 'edit'])->name('ratings.edit');
    Route::put('/ratings/{rating}', [ClientRatingController::class, 'update'])->name('ratings.update');
    Route::delete('/ratings/{rating}', [ClientRatingController::class, 'destroy'])->name('ratings.destroy');
});

// Provider Routes
Route::middleware(['auth', 'role:provider'])->prefix('provider')->name('provider.')->group(function () {
    // Profile Routes
    Route::get('/profile', [ProviderProfileController::class, 'showProfile'])->name('profile');
    Route::put('/profile', [ProviderProfileController::class, 'updateProfile'])->name('profile.update');
    Route::get('/next-steps', [ProviderProfileController::class, 'showNextSteps'])->name('next-steps');

    // Service Routes
    Route::get('/services/create', [\App\Http\Controllers\Provider\ServiceController::class, 'create'])->name('services.create');
    Route::post('/services', [\App\Http\Controllers\Provider\ServiceController::class, 'store'])->name('services.store');
    Route::put('/services/{service}/toggle-status', [\App\Http\Controllers\Provider\ServiceController::class, 'toggleStatus'])->name('services.toggle-status');
    
    // Booking Routes
    Route::get('/bookings', [ProviderBookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/{booking}', [ProviderBookingController::class, 'show'])->name('bookings.show');
    Route::post('/bookings/{booking}/confirm', [ProviderBookingController::class, 'confirm'])->name('bookings.confirm');
    Route::post('/bookings/{booking}/cancel', [ProviderBookingController::class, 'cancel'])->name('bookings.cancel');
    Route::post('/bookings/{booking}/complete', [ProviderBookingController::class, 'complete'])->name('bookings.complete');
    
    // Rating Routes
    Route::get('/ratings', [ProviderRatingController::class, 'index'])->name('ratings.index');
    Route::get('/ratings/{rating}', [ProviderRatingController::class, 'show'])->name('ratings.show');
    Route::get('/ratings/{rating}/reply', [ProviderRatingController::class, 'reply'])->name('ratings.reply');
    Route::post('/ratings/{rating}/reply', [ProviderRatingController::class, 'storeReply'])->name('ratings.store-reply');
    
    // Availability Routes
    Route::get('/availabilities', [AvailabilityController::class, 'index'])->name('availabilities.index');
    Route::get('/availabilities/create', [AvailabilityController::class, 'create'])->name('availabilities.create');
    Route::post('/availabilities', [AvailabilityController::class, 'store'])->name('availabilities.store');
    Route::get('/availabilities/{availability}/edit', [AvailabilityController::class, 'edit'])->name('availabilities.edit');
    Route::put('/availabilities/{availability}', [AvailabilityController::class, 'update'])->name('availabilities.update');
    Route::delete('/availabilities/{availability}', [AvailabilityController::class, 'destroy'])->name('availabilities.destroy');
    Route::get('/availabilities/calendar', [AvailabilityController::class, 'calendar'])->name('availabilities.calendar');
});

// Profile Routes (unified for all users)
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.updateProfile');
    Route::put('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
    Route::put('/profile/bookings/{booking}/cancel', [ProfileController::class, 'cancelBooking'])->name('profile.cancelBooking');
    Route::put('/profile/bookings/{booking}/confirm', [ProfileController::class, 'confirmBooking'])->name('profile.confirmBooking');
    Route::put('/profile/bookings/{booking}/complete', [ProfileController::class, 'completeBooking'])->name('profile.completeBooking');
});