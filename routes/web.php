<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\CategoryController;



Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/event/1', [EventController::class, 'show'])->name('events.show');

Route::get('/checkout', [EventController::class, 'checkout'])->name('checkout');

Route::get('/my-ticket', [TicketController::class, 'index'])->name('ticket');



Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/events', [AdminEventController::class, 'index'])->name('events');

    Route::get('/transactions', function () {
        return view('admin.transactions');
    })->name('transactions');

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');

});