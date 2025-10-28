<?php

use App\Http\Controllers\Api\BlogCategoryController;
use App\Http\Controllers\Api\BlogCommentController;
use App\Http\Controllers\Api\BlogController;
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

Route::prefix('v1')->group(function () {
    // Blog Category routes
    Route::apiResource('blog-categories', BlogCategoryController::class);
    
    // Blog routes
    Route::apiResource('blogs', BlogController::class);
    
    // Blog Comment routes
    Route::apiResource('blog-comments', BlogCommentController::class);
    
    // Additional routes for specific functionality
    Route::get('blogs/category/{category}', [BlogController::class, 'indexByCategory']);
    Route::get('blogs/author/{author}', [BlogController::class, 'indexByAuthor']);
});