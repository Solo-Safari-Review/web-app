<?php

use App\Http\Controllers\CategorizedReviewController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TopicController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('home');
    return csrf_token();
});

Route::get('/login', [LoginController::class, 'show'])->name('login.show');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::middleware(['role:review_admin'])->group(function () {
        Route::resource('categories', CategoryController::class);
        Route::resource('topics', TopicController::class);
    });
    Route::middleware(['role:department_admin|review_admin'])->group(function () {
        Route::resource('reviews', ReviewController::class);
        Route::resource('categorized-reviews', CategorizedReviewController::class);
    });
});

