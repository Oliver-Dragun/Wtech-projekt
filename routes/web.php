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

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index']);
Route::get('/shop', [ShopController::class, 'index']);
Route::get('/search', [ShopController::class, 'search']);
Route::get('/product/{id}', [ProductController::class, 'show']);

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/items/{productId}', [CartController::class, 'updateItem'])->name('cart.update');

Route::get('/checkout', [CheckoutController::class, 'index'])->middleware('auth');
Route::post('/checkout', [CheckoutController::class, 'store'])->middleware('auth');

Route::get('/payment', [PaymentController::class, 'index'])->middleware('auth');
Route::post('/payment', [PaymentController::class, 'store'])->middleware('auth');

Route::get('/profile', function () {
    $user = auth()->user()->load('address');
    $orders = Order::with(['items.product.mainPhoto', 'status'])
        ->where('user_id', $user->id)
        ->whereNotNull('status_id')
        ->orderByDesc('date')
        ->get();
    return view('pages.profile', compact('user', 'orders'));
})->middleware('auth');

Route::patch('/profile', function (Request $request) {
    $user = auth()->user();

    $validated = $request->validate([
        'full_name' => 'required|string|max:127',
        'email' => 'required|email|max:127|unique:users,email,' . $user->id,
        'phone_number' => 'nullable|string|max:31',
        'street_address' => 'nullable|string|max:255',
        'postal_code' => 'nullable|string|max:15',
        'city' => 'nullable|string|max:127',
        'country' => 'nullable|string|max:127',
    ]);

    $parts = explode(' ', trim($validated['full_name']), 2);
    $user->update([
        'name' => $parts[0],
        'surname' => $parts[1] ?? '',
        'email' => $validated['email'],
        'phone_number' => $validated['phone_number'] ?? null,
    ]);

    $hasAddress = !empty($validated['street_address'])
               || !empty($validated['city'])
               || !empty($validated['postal_code'])
               || !empty($validated['country']);

    if ($hasAddress) {
        if ($user->address) {
            $user->address->update([
                'street_address' => $validated['street_address'] ?? $user->address->street_address,
                'city' => $validated['city'] ?? $user->address->city,
                'postal_code' => $validated['postal_code'] ?? $user->address->postal_code,
                'country' => $validated['country'] ?? $user->address->country,
            ]);
        } else {
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

Route::post('/reviews', [ReviewController::class, 'store'])->middleware('auth');

Route::get('/admin', [\App\Http\Controllers\AdminController::class, 'index'])->middleware('admin');

require __DIR__.'/auth.php';
