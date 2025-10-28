<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\BlogCommentController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});

// API-like routes for blog resources (non-authenticated)
Route::resource('blogs', BlogController::class);
Route::resource('blog-categories', BlogCategoryController::class);
Route::resource('blog-comments', BlogCommentController::class);

// API Documentation routes
Route::get('/docs', function () {
    return redirect('/docs/index.html');
});

Route::get('/docs/api', function () {
    return redirect('/docs/api.html');
});

require __DIR__.'/auth.php';
