<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\ReviewController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\TransactionController;


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');

Route::get('/checkout', [EventController::class, 'checkout'])->name('checkout');

Route::get('/checkout/{event}', [CheckoutController::class, 'create'])
    ->name('checkout.create');

Route::post('/checkout/{event}', [CheckoutController::class, 'store'])
    ->name('checkout.store');

Route::get('/payment/{order_id}', [CheckoutController::class, 'payment'])
    ->name('checkout.payment');

Route::get('/success/{order_id}', [CheckoutController::class, 'success'])
    ->name('checkout.success');

Route::get('/my-ticket', [TicketController::class, 'index'])->name('ticket');

// Review Routes
Route::get('/events/{event}/reviews', [ReviewController::class, 'index'])->name('reviews.index');
Route::get('/events/{event}/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
Route::post('/events/{event}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
Route::get('/reviews/{review}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
Route::put('/reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');
Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
Route::get('/my-reviews', [ReviewController::class, 'myReviews'])->name('reviews.my');
Route::get('/events/{event}/rating-stats', [ReviewController::class, 'getRatingStats'])->name('rating.stats');
Route::get('/events/{event}/review-status', [ReviewController::class, 'getReviewStatus'])->name('review.status');

Route::post('/midtrans/callback', [\App\Http\Controllers\MidtransWebhookController::class, 'handle']);

// Google SSO (Laravel Socialite)
Route::get('/auth/google',          [SocialAuthController::class, 'redirect'])->name('auth.google');
Route::get('/auth/google/callback', [SocialAuthController::class, 'callback'])->name('auth.google.callback');

// Global login route for authentication middleware
Route::redirect('/login', '/admin/login')->name('login');

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');

    Route::post('login', [AuthController::class, 'login'])->name('login.post');

    Route::middleware(['auth', 'admin'])->group(function () {

        Route::post('logout', [AuthController::class, 'logout'])->name('logout');

        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/events', [AdminEventController::class, 'index'])
            ->name('events.index');

        Route::get('/events/create', [AdminEventController::class, 'create'])
            ->name('events.create');

        Route::post('/events', [AdminEventController::class, 'store'])
            ->name('events.store');

        Route::get('/events/{event}/edit', [AdminEventController::class, 'edit'])
            ->name('events.edit');

        Route::put('/events/{event}', [AdminEventController::class, 'update'])
            ->name('events.update');

        Route::delete('/events/{event}', [AdminEventController::class, 'destroy'])
            ->name('events.destroy');

        Route::get('/transactions', [TransactionController::class, 'index'])
            ->name('transactions.index');

        // CATEGORY ROUTES
        Route::get('/categories', [CategoryController::class, 'index'])
            ->name('categories.index');

        Route::get('/categories/create', [CategoryController::class, 'create'])
            ->name('categories.create');

        Route::post('/categories', [CategoryController::class, 'store'])
            ->name('categories.store');

        Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])
            ->name('categories.edit');

        Route::put('/categories/{category}', [CategoryController::class, 'update'])
            ->name('categories.update');

        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])
            ->name('categories.destroy');

        // PARTNER ROUTES
        // READ
        Route::get('/partners', [PartnerController::class, 'index'])
            ->name('partners.index');

        // CREATE FORM
        Route::get('/partners/create', [PartnerController::class, 'create'])
            ->name('partners.create');

        // STORE DATA
        Route::post('/partners', [PartnerController::class, 'store'])
            ->name('partners.store');

        // EDIT FORM
        Route::get('/partners/{partner}/edit', [PartnerController::class, 'edit'])
            ->name('partners.edit');

        // UPDATE DATA
        Route::put('/partners/{partner}', [PartnerController::class, 'update'])
            ->name('partners.update');

        // DELETE DATA
        Route::delete('/partners/{partner}', [PartnerController::class, 'destroy'])
            ->name('partners.destroy');

        Route::get('transactions', [\App\Http\Controllers\Admin\TransactionController::class, 'index'])
            ->name('transactions.index');

    });

});