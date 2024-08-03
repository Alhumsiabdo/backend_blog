<?php

namespace App\Providers;

use App\Repository\Dashboard\AuthRepositoryInterface;
use App\Repository\Dashboard\CategoryRepositoryInterface;
use App\Repository\Dashboard\Eloquent\AuthRepository;
use App\Repository\Dashboard\Eloquent\CategoryRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
