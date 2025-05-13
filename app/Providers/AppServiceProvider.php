<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\AuthRepository;
use App\Repositories\GoogleAuthRepository;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use App\Repositories\Interfaces\GoogleAuthRepositoryInterface;
use App\Repositories\BookingRepository;
use App\Repositories\RatingRepository;
use App\Repositories\MessageRepository;
use App\Repositories\BadgeRepository;
use App\Repositories\GamificationRepository;
use App\Repositories\AvailabilityRepository;
use App\Repositories\Interfaces\BookingRepositoryInterface;
use App\Repositories\Interfaces\RatingRepositoryInterface;
use App\Repositories\Interfaces\MessageRepositoryInterface;
use App\Repositories\Interfaces\BadgeRepositoryInterface;
use App\Repositories\Interfaces\GamificationRepositoryInterface;
use App\Repositories\Interfaces\AvailabilityRepositoryInterface;
use App\Services\BookingService;
use App\Services\RatingService;
use App\Services\MessageService;
use App\Services\BadgeService;
use App\Services\GamificationService;
use App\Services\AvailabilityService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Bind existing repositories
        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
        $this->app->bind(GoogleAuthRepositoryInterface::class, GoogleAuthRepository::class);
        
        // Bind new repositories
        $this->app->bind(BookingRepositoryInterface::class, BookingRepository::class);
        $this->app->bind(RatingRepositoryInterface::class, RatingRepository::class);
        $this->app->bind(MessageRepositoryInterface::class, MessageRepository::class);
        $this->app->bind(BadgeRepositoryInterface::class, BadgeRepository::class);
        $this->app->bind(GamificationRepositoryInterface::class, GamificationRepository::class);
        $this->app->bind(AvailabilityRepositoryInterface::class, AvailabilityRepository::class);
        
        // Register services as singletons to prevent multiple instantiations
        $this->app->singleton(BookingService::class, function ($app) {
            return new BookingService(
                $app->make(BookingRepositoryInterface::class),
                $app->make(\App\Repositories\Interfaces\ServiceRepositoryInterface::class),
                $app->make(AvailabilityRepositoryInterface::class),
                $app->make(\App\Repositories\Interfaces\UserRepositoryInterface::class)
            );
        });
        
        $this->app->singleton(RatingService::class, function ($app) {
            return new RatingService(
                $app->make(RatingRepositoryInterface::class),
                $app->make(\App\Repositories\Interfaces\ServiceRepositoryInterface::class),
                $app->make(\App\Repositories\Interfaces\UserRepositoryInterface::class),
                $app->make(BookingRepositoryInterface::class)
            );
        });
        
        $this->app->singleton(MessageService::class, function ($app) {
            return new MessageService(
                $app->make(MessageRepositoryInterface::class),
                $app->make(\App\Repositories\Interfaces\UserRepositoryInterface::class)
            );
        });
        
        $this->app->singleton(BadgeService::class, function ($app) {
            return new BadgeService(
                $app->make(BadgeRepositoryInterface::class),
                $app->make(\App\Repositories\Interfaces\UserRepositoryInterface::class)
            );
        });
        
        $this->app->singleton(GamificationService::class, function ($app) {
            return new GamificationService(
                $app->make(GamificationRepositoryInterface::class),
                $app->make(BadgeRepositoryInterface::class),
                $app->make(\App\Repositories\Interfaces\UserRepositoryInterface::class),
                $app->make(BookingRepositoryInterface::class),
                $app->make(RatingRepositoryInterface::class)
            );
        });
        
        $this->app->singleton(AvailabilityService::class, function ($app) {
            return new AvailabilityService(
                $app->make(AvailabilityRepositoryInterface::class),
                $app->make(\App\Repositories\Interfaces\ServiceRepositoryInterface::class),
                $app->make(BookingRepositoryInterface::class)
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        
    }
}