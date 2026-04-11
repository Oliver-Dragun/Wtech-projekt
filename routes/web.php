<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index']);
Route::get('/shop', [ShopController::class, 'index']);
Route::get('/search', [ShopController::class, 'search']);
Route::get('/product/{id}', [ProductController::class, 'show']);

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/items/{productId}', [CartController::class, 'updateItem'])->name('cart.update');

Route::get('/checkout', fn() => view('pages.checkout'))->middleware('auth');
Route::get('/payment', fn() => view('pages.payment'));
Route::get('/profile', fn() => view('pages.profile'));
Route::get('/edit-profile', fn() => view('pages.edit-profile'));
Route::get('/admin', [\App\Http\Controllers\AdminController::class, 'index'])->middleware('admin');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
