<?php

use App\Http\Controllers\CategorizedReviewController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ConfirmAccountsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ScrapingController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\TrashController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (!Auth::check()) {return redirect('/login');}

    return redirect()->route('reviews.index');
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
    Route::get('reviews/all', [ReviewController::class, 'allReviews'])->name('reviews.all');
    Route::resource('reviews', ReviewController::class);

    Route::resource('topics', TopicController::class);

    Route::get('/search', [SearchController::class, 'search'])->name('search');
    Route::get('/search/show', [SearchController::class, 'searchView'])->name('search.show');

    Route::get('user', [UserController::class, 'index'])->name('user.index');

    Route::middleware(['role:Admin Review'])->group(function () {
        Route::delete('reviews/destroy-some', [ReviewController::class, 'destroySome'])->name('reviews.destroy-some');

        Route::delete('categories/destroy-some', [CategoryController::class, 'destroySome'])->name('categories.destroy-some');
        Route::resource('categories', CategoryController::class)->except('destroySome');

        Route::resource('categorized-reviews', CategorizedReviewController::class)->only(['index', 'store', 'show']);

        Route::delete('topics/destroy-some', [TopicController::class, 'destroySome'])->name('topics.destroy-some');

        Route::get('trash', [TrashController::class, 'index'])->name('trash.index');
        Route::get('trash/{trash}', [TrashController::class, 'show'])->name('trash.show');
        Route::delete('trash/destroy', [TrashController::class, 'destroy'])->name('trash.destroy');

        Route::get('confirm-accounts', [ConfirmAccountsController::class, 'index'])->name('confirm-accounts.index');
        Route::get('confirm-accounts/{account}', [ConfirmAccountsController::class, 'showConfirm'])->name('confirm-accounts.show-confirm');
        Route::put('confirm-accounts/confirm-some', [ConfirmAccountsController::class, 'confirmSome'])->name('confirm-accounts.confirm-some');
        Route::delete('confirm-accounts/destroy-some', [ConfirmAccountsController::class, 'destroySome'])->name('confirm-accounts.destroy-some');

        Route::resource('user', UserController::class)->except(['index']);

        Route::get('/get-reviews', [ScrapingController::class, 'getScrapingData'])->name('get-reviews');
    });

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

