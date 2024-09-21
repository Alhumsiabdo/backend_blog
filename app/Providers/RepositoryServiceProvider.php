<?php

namespace App\Providers;

use App\Repository\Dashboard\{
    AdminRepositoryInterface,
    AuthRepositoryInterface,
    CategoryRepositoryInterface,
    CommentRepositoryInterface,
    PostRepositoryInterface,
    TagRepositoryInterface,
};
use App\Repository\Dashboard\Eloquent\{
    AdminRepository,
    AuthRepository,
    CategoryRepository,
    CommentRepository,
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
        $this->app->bind(AdminRepositoryInterface::class, AdminRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
        $this->app->bind(TagRepositoryInterface::class, TagRepository::class);
        $this->app->bind(CommentRepositoryInterface::class, CommentRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
