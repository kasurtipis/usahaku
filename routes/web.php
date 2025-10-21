<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\BlogCommentController;
use Illuminate\Support\Facades\Route;

Route::resource('blogs', BlogController::class);
Route::resource('blog-categories', BlogCategoryController::class);
Route::resource('blog-comments', BlogCommentController::class);
