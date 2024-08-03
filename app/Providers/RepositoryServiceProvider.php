<?php

namespace App\Providers;

use App\Repository\Dashboard\AuthRepositoryInterface;
use App\Repository\Dashboard\CategoryRepositoryInterface;
use App\Repository\Dashboard\Eloquent\AuthRepository;
use App\Repository\Dashboard\Eloquent\CategoryRepository;
use App\Repository\Dashboard\Eloquent\PostRepository;
use App\Repository\Dashboard\PostRepositoryInterface;
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
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
