<?php

use App\Http\Controllers\Dashboard\Api\AuthController;
use App\Http\Controllers\Dashboard\Api\CategoryController;
use App\Http\Controllers\Dashboard\Api\PostController;
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
Route::post('auth/register', [AuthController::class, 'register']);
Route::post('auth/login', [AuthController::class, 'login']);

Route::group([

    'middleware' => 'auth:api',
    'prefix' => 'auth'

], function () {
    Route::post('logout', [AuthController::class, 'logout']);

    // Categories Route
    Route::get('categories', [CategoryController::class, 'index']);
    Route::get('category/{id}', [CategoryController::class, 'show']);
    Route::post('category/create', [CategoryController::class, 'store']);
    Route::post('category/edit/{id}', [CategoryController::class, 'update']);
    Route::delete('category/destroy/{id}', [CategoryController::class, 'destroy']);

    // Posts Route
    Route::get('posts', [PostController::class, 'index']);
    Route::get('post/{id}', [PostController::class, 'show']);
    Route::post('change-status/{id}', [PostController::class, 'changeStatus']);
    Route::delete('post/destroy/{id}', [PostController::class, 'destroy']);
});
