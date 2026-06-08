<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StockMovementController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('categories', CategoryController::class)->except(['show']);

Route::resource('products', ProductController::class);

Route::get('/stock-movements', [StockMovementController::class, 'index'])
    ->name('stock-movements.index');

Route::get('/stock-movements/create', [StockMovementController::class, 'create'])
    ->name('stock-movements.create');

Route::post('/stock-movements', [StockMovementController::class, 'store'])
    ->name('stock-movements.store');