<?php

use Takshak\Adash\Http\Middleware\ReferrerMiddleware;
use Takshak\Adash\Http\Middleware\GatesMiddleware;
use Takshak\Areviews\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;
use Takshak\Areviews\Http\Controllers\Admin\ReviewController as AdminReviewController;

Route::middleware('web')->group(function () {
    Route::post('review', [ReviewController::class, 'store'])->name('review.store');
    Route::middleware(['auth', GatesMiddleware::class, ReferrerMiddleware::class])
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {
            Route::resource('reviews', AdminReviewController::class);
            Route::get('reviews/status-toggle/status', [AdminReviewController::class, 'statusToggle'])->name('reviews.status-toggle');
        });
});
