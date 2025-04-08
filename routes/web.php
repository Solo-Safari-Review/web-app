<?php

use App\Http\Controllers\ReviewController;
use App\Models\CategorizedReview;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('reviews', ReviewController::class);
Route::resource('categorized-reviews', CategorizedReview::class);
