<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\Admin\ReservationController as AdminReservationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicReservationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BillController;
use App\Http\Middleware\CustomerMiddleware;

// Public Pages
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/menu', [HomeController::class, 'menu'])->name('menu');
Route::get('/events', [HomeController::class, 'events'])->name('events');
Route::get('/story', [HomeController::class, 'story'])->name('story');

// Reservation Routes
Route::get('/reservations', [PublicReservationController::class, 'create'])->name('reservations.create');
Route::post('/reservations', [PublicReservationController::class, 'store'])->name('reservations.store');
Route::get('/check-availability', [PublicReservationController::class, 'checkAvailability'])->name('reservations.check-availability');

// Authentication Routes
Auth::routes(['verify' => true]);

// Email OTP Verification Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/email/verify-otp', [App\Http\Controllers\Auth\EmailVerificationController::class, 'showVerificationForm'])
        ->name('verification.notice');
    Route::post('/email/verify-otp', [App\Http\Controllers\Auth\EmailVerificationController::class, 'verifyOTP'])
        ->name('verification.verify-otp');
    Route::post('/email/send-otp', [App\Http\Controllers\Auth\EmailVerificationController::class, 'sendOTP'])
        ->name('verification.send-otp');
});

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/notifications', [ProfileController::class, 'notifications'])->name('profile.notifications');
    Route::post('/profile/notifications/{notification}/mark-as-read', [ProfileController::class, 'markNotificationAsRead'])
        ->name('profile.notifications.mark-as-read');
});

// Customer Bill Routes
Route::middleware(['auth', CustomerMiddleware::class])->group(function () {
    Route::post('/bills/{reservation}/generate', [BillController::class, 'generate'])->name('bills.generate');
    Route::get('/bills/{bill}', [BillController::class, 'show'])->name('bills.show');
    Route::post('/bills/{bill}/process-payment', [BillController::class, 'processPayment'])->name('bills.process-payment');
    Route::get('/bills/{bill}/download-pdf', [BillController::class, 'downloadPdf'])->name('bills.download-pdf');
});

// Admin Routes
Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Menu Management
    Route::resource('menu', MenuController::class)->parameters([
        'menu' => 'menuItem'
    ]);

    // Table Management
    Route::resource('tables', TableController::class);
    Route::get('/tables/layout', [TableController::class, 'layout'])->name('tables.layout');
    Route::get('/tables/status', [TableController::class, 'getStatus'])->name('tables.status');
    Route::get('/tables/{table}/details', [TableController::class, 'getDetails'])->name('tables.details');
    Route::post('tables/{table}/status', [TableController::class, 'updateStatus'])->name('tables.status');

    // Reservation Management
    Route::resource('reservations', AdminReservationController::class);
    Route::get('/reservations/{reservation}/assign-table', [AdminReservationController::class, 'assignTable'])
        ->name('reservations.assign-table');
    Route::get('/reservations/calendar', [AdminReservationController::class, 'calendar'])
        ->name('reservations.calendar');

    // Bills Management
    Route::get('/bills', [BillController::class, 'index'])->name('bills.index');
    Route::get('/bills/{bill}', [BillController::class, 'show'])->name('bills.show');
    Route::post('/bills/{reservation}/generate', [BillController::class, 'generate'])->name('bills.generate');
    Route::post('/bills/{bill}/process-payment', [BillController::class, 'processPayment'])->name('bills.process-payment');
    Route::get('/bills/{bill}/download-pdf', [BillController::class, 'downloadPdf'])->name('bills.download-pdf');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
