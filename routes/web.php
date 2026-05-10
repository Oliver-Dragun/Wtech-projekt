<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ShopController;
use App\Models\Address;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Routes for the whole app

// Store paths
Route::get('/', [\App\Http\Controllers\HomeController::class, 'index']);
Route::get('/shop', [ShopController::class, 'index']);
Route::get('/search', [ShopController::class, 'search']);
Route::get('/product/{id}', [ProductController::class, 'show']);

// Cart paths
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/items/{productId}', [CartController::class, 'updateItem'])->name('cart.update');

// Checkout and payment, both require login to allow access 
Route::get('/checkout', [CheckoutController::class, 'index'])->middleware('auth');
Route::post('/checkout', [CheckoutController::class, 'store'])->middleware('auth');

Route::get('/payment', [PaymentController::class, 'index'])->middleware('auth');
Route::post('/payment', [PaymentController::class, 'store'])->middleware('auth');

// Profile path, builds user info inline
Route::get('/profile', function () {
    $user = auth()->user()->load('address');
    $orders = Order::with(['items.product.mainPhoto', 'status'])
        ->where('user_id', $user->id)
        ->whereNotNull('status_id')
        ->orderByDesc('date')
        ->get();
    return view('pages.profile', compact('user', 'orders'));
})->middleware('auth');

// Update profile
Route::patch('/profile', function (Request $request) {
    $user = auth()->user();

    // Validates text fields, allows same email as before edits
    $validated = $request->validate([
        'full_name' => ['required', 'string', 'max:127', function ($attr, $value, $fail) {
            $parts = explode(' ', trim($value), 2);
            if (strlen($parts[0]) > 63 || strlen($parts[1] ?? '') > 63) {
                $fail('Name and surname must each be at most 63 characters.');
            }
        }],
        'email' => 'required|email|max:127|unique:users,email,' . $user->id,
        'phone_number' => 'nullable|string|max:31',
        'street_address' => 'nullable|string|max:255',
        'postal_code' => 'nullable|string|max:15',
        'city' => 'nullable|string|max:127',
        'country' => 'nullable|string|max:127',
    ]);

    // Split full_name into name and surname on first space
    $parts = explode(' ', trim($validated['full_name']), 2);
    $user->update([
        'name' => $parts[0],
        'surname' => $parts[1] ?? '',
        'email' => $validated['email'],
        'phone_number' => $validated['phone_number'] ?? null,
    ]);

    // Update address
    $hasAddress = !empty($validated['street_address'])
               || !empty($validated['city'])
               || !empty($validated['postal_code'])
               || !empty($validated['country']);

    if ($hasAddress) {
        if ($user->address) {
            // Update existing address
            $user->address->update([
                'street_address' => $validated['street_address'] ?? $user->address->street_address,
                'city' => $validated['city'] ?? $user->address->city,
                'postal_code' => $validated['postal_code'] ?? $user->address->postal_code,
                'country' => $validated['country'] ?? $user->address->country,
            ]);
        } else {
            // New address
            $address = Address::create([
                'street_address' => $validated['street_address'] ?? '',
                'city'           => $validated['city'] ?? '',
                'postal_code'    => $validated['postal_code'] ?? '',
                'country'        => $validated['country'] ?? '',
            ]);
            $user->update(['address_id' => $address->id]);
        }
    }

    return redirect('/profile');
})->middleware('auth');

// Only logged in users can leave reviews
Route::post('/reviews', [ReviewController::class, 'store'])->middleware('auth');

// Admin routes behind IsAdmin middleware registered under alias 'admin' in bootstrap/app.php
Route::middleware('admin')->group(function () {
    Route::get('/admin', [\App\Http\Controllers\AdminController::class, 'index']);
    Route::get('/admin/products/create', [\App\Http\Controllers\AdminController::class, 'create'])->name('admin.products.create');
    Route::post('/admin/products', [\App\Http\Controllers\AdminController::class, 'store'])->name('admin.products.store');
    Route::get('/admin/products/{product}/edit', [\App\Http\Controllers\AdminController::class, 'edit'])->name('admin.products.edit');
    Route::patch('/admin/products/{product}', [\App\Http\Controllers\AdminController::class, 'update'])->name('admin.products.update');
    Route::delete('/admin/products/{product}', [\App\Http\Controllers\AdminController::class, 'destroy'])->name('admin.products.destroy');
});

// Runs auth paths
require __DIR__.'/auth.php';
