<?php

namespace App\Providers;

use App\Repository\Dashboard\{
    AuthRepositoryInterface,
    CategoryRepositoryInterface,
    PostRepositoryInterface,
    TagRepositoryInterface,
};
use App\Repository\Dashboard\Eloquent\{
    AuthRepository,
    CategoryRepository,
    PostRepository,
    TagRepository
};
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
        $this->app->bind(TagRepositoryInterface::class, TagRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
