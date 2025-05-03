<?php

use App\Helpers\HashidsHelper;
use App\Http\Controllers\CategorizedReviewController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TopicController;
use App\Models\Category;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (!Auth::check()) {return redirect('/login');}

    $reviews = Review::with('categorizedReview', 'topics')->limit(5)->get();

    return view('home', [
        'reviews' => $reviews,
    ]);
    // return response()->json([
    //     'csrf_token' => csrf_token(),
    // ]);
});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'show'])->name('login.show');
    Route::post('/login', [LoginController::class, 'login'])->name('login');

    Route::get('/register', [RegisterController::class, 'show'])->name('register.show');
    Route::post('/register', [RegisterController::class, 'register'])->name('register');

    Route::get('/forgot-password', [LoginController::class, 'showForgotPassword'])->name('forgot-password.show');
    Route::post('/forgot-password', [LoginController::class, 'sendResetPassword'])->name('forgot-password.send');

    Route::get('/reset-password/{token}', [LoginController::class, 'showResetPassword'])->name('reset-password.show');
    Route::post('/reset-password', [LoginController::class, 'resetPassword'])->name('reset-password');
});

Route::middleware(['auth'])->group(function () {
    Route::middleware(['role:Admin Review'])->group(function () {
        Route::resource('categories', CategoryController::class);
        Route::resource('topics', TopicController::class);
        Route::resource('categorized-reviews', CategorizedReviewController::class)->only(['store']);
    });
    Route::middleware(['role:Admin Departemen|Admin Review'])->group(function () {
        Route::get('reviews/all', [ReviewController::class, 'allReviews'])->name('reviews.all');
        Route::resource('reviews', ReviewController::class)->only(['index', 'show', 'store', 'edit', 'update', 'destroy']);
        Route::get('/search', [SearchController::class, 'search'])->name('search');
        Route::get('/search/show', [SearchController::class, 'searchView'])->name('search.show');
    });
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

