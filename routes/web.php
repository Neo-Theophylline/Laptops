<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LaptopController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ServiceItemController;
use App\Http\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

    // Other routes
    Route::resources([
        'users' => UserController::class,
        'laptops' => LaptopController::class,
        'serviceitems' => ServiceItemController::class,
        'services' => ServiceController::class,
        'payments' => PaymentController::class,
    ]);

    Route::put('/services/{id}/update-detail', [ServiceController::class, 'updateDetail'])->name('services.updateDetail');
});

