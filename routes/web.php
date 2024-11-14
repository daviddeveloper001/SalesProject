<?php

use App\Http\Middleware\AuxiliarMiddleware;
use App\Http\Middleware\VendedorMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SaleItemsController;

// Rutas que requieren autenticación general
Route::middleware('auth')->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::middleware(AuxiliarMiddleware::class)->group(function () {
        Route::resource('products', ProductController::class)->except(['show']);
    });

    Route::middleware(VendedorMiddleware::class)->group(function () {
        Route::resource('sales', SaleController::class)->except(['edit', 'update', 'show']);
        Route::resource('sales-items', SaleItemsController::class)->except(['edit', 'update', 'show']);
    });
});
