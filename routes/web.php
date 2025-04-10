<?php

use App\Http\Controllers\CategorizedReviewController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('reviews', ReviewController::class);
Route::resource('categorized-reviews', CategorizedReviewController::class);
Route::resource('categories', CategoryController::class);
