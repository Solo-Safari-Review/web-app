<?php

use App\Http\Controllers\CategorizedReviewController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TopicController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return csrf_token();
});

Route::get('/login', [LoginController::class, 'show'])->name('login.show');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware(['auth', 'role:admin_review'])->group(function () {
    Route::resource('reviews', ReviewController::class);
    Route::resource('categorized-reviews', CategorizedReviewController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('topics', TopicController::class);
});

Route::middleware(['auth', 'role:admin_departemen'])->group(function () {
    Route::resource('reviews', ReviewController::class)->only('index', 'show');
    Route::resource('categorized-reviews', CategorizedReviewController::class)->only('index', 'show');
    Route::resource('categories', CategoryController::class)->only('index', 'show');
    Route::resource('topics', TopicController::class)->only('index', 'show');
});
