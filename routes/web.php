<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('pages.home'));
Route::get('/shop', [ShopController::class, 'index']);
Route::get('/product/{id}', [ProductController::class, 'show']);

Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/items/{id}', [CartController::class, 'updateItem'])->name('cart.update');
});
Route::get('/checkout', fn() => view('pages.checkout'));
Route::get('/payment', fn() => view('pages.payment'));
Route::get('/profile', fn() => view('pages.profile'));
Route::get('/edit-profile', fn() => view('pages.edit-profile'));
Route::get('/admin', fn() => view('pages.admin'));

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
