<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\AuthRepository;
use App\Repositories\GoogleAuthRepository;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use App\Repositories\Interfaces\GoogleAuthRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\UserRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
        $this->app->bind(GoogleAuthRepositoryInterface::class, GoogleAuthRepository::class);
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app['router']->aliasMiddleware('role_permission', \App\Http\Middleware\CheckRolePermission::class);
    }
}