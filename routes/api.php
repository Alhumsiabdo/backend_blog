<?php

use App\Http\Controllers\Dashboard\Api\{
    AuthController,
    CategoryController,
    CommentController,
    PostController,
    TagController
};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Public routes that do not require authentication
Route::controller(AuthController::class)->group(function () {
    Route::post('auth/register', 'register');
    Route::post('auth/login', 'login');
});

Route::group([

    'middleware' => 'auth:api',
    'prefix' => 'auth'

], function () {
    Route::post('logout', [AuthController::class, 'logout']);

    // Categories Route
    Route::controller(CategoryController::class)->group(function () {
        Route::get('categories', 'index');
        Route::get('category/{id}', 'show');
        Route::post('category/create', 'store');
        Route::post('category/edit/{id}', 'update');
        Route::delete('category/destroy/{id}', 'destroy');
    });


    // Posts Route
    Route::controller(PostController::class)->group(function () {
        Route::get('posts', 'index');
        Route::get('post/{id}', 'show');
        Route::post('change-status/{id}', 'changeStatus');
        Route::delete('post/destroy/{id}', 'destroy');
    });

    // Tags Route
    Route::controller(TagController::class)->group(function () {
        Route::get('tags', 'index');
        Route::get('tag/{id}', 'show');
        Route::post('tag/create', 'store');
        Route::post('tag/edit/{id}', 'update');
        Route::delete('tag/destroy/{id}', 'destroy');
    });

    // Comments Route
    Route::controller(CommentController::class)->group(function () {
        Route::get('post/{post}/comments', 'showCommentsByPostId');
        Route::delete('comment/destroy/{id}', 'destroy');
    });
});
