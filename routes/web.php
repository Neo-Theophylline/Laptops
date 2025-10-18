<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LaptopController;
use App\Http\Controllers\ServiceItemController;
use App\Http\Controllers\ServiceController;

// Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

// Other routes
Route::resources([
    'users' => UserController::class,
    'laptops' => LaptopController::class,
    'serviceitems' => ServiceItemController::class,
    'services' => ServiceController::class,
]);

