<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Register Repositories
        $this->app->bind(
            \App\Repositories\Interfaces\UserRepositoryInterface::class,
            \App\Repositories\UserRepository::class
        );

        $this->app->bind(
            \App\Repositories\Interfaces\RoleRepositoryInterface::class,
            \App\Repositories\RoleRepository::class
        );

        $this->app->bind(
            \App\Repositories\Interfaces\PermissionRepositoryInterface::class,
            \App\Repositories\PermissionRepository::class
        );

        $this->app->bind(
            \App\Repositories\Interfaces\CategoryRepositoryInterface::class,
            \App\Repositories\CategoryRepository::class
        );

        $this->app->bind(
            \App\Repositories\Interfaces\ServiceRepositoryInterface::class,
            \App\Repositories\ServiceRepository::class
        );

        $this->app->bind(
            \App\Repositories\Interfaces\BookingRepositoryInterface::class,
            \App\Repositories\BookingRepository::class
        );

        $this->app->bind(
            \App\Repositories\Interfaces\RatingRepositoryInterface::class,
            \App\Repositories\RatingRepository::class
        );

        $this->app->bind(
            \App\Repositories\Interfaces\MessageRepositoryInterface::class,
            \App\Repositories\MessageRepository::class
        );

        $this->app->bind(
            \App\Repositories\Interfaces\BadgeRepositoryInterface::class,
            \App\Repositories\BadgeRepository::class
        );

        $this->app->bind(
            \App\Repositories\Interfaces\GamificationRepositoryInterface::class,
            \App\Repositories\GamificationRepository::class
        );

        $this->app->bind(
            \App\Repositories\Interfaces\AvailabilityRepositoryInterface::class,
            \App\Repositories\AvailabilityRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
