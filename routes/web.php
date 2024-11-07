<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::resource('products', App\Http\Controllers\ProductController::class)->except('edit', 'update', 'show');


Route::resource('sales', App\Http\Controllers\SaleController::class)->except('edit', 'update', 'show');

Route::resource('sales-items', App\Http\Controllers\SaleItemsController::class)->except('edit', 'update', 'show');
