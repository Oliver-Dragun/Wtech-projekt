<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use App\Models\ShippingMethod;
use Illuminate\Http\Request;

// Handles the checkout page and order submission
class CheckoutController extends Controller
{
    // Shows the checkout form with cart items and shipping options
    public function index()
    {
        $cart = Order::with(['items.product.mainPhoto'])
            ->activeCart()
            ->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index');
        }

        $shippingMethods = ShippingMethod::all();
        $subtotal = $cart->items->sum(fn($item) => $item->product->price * $item->quantity);

        return view('pages.checkout', compact('cart', 'shippingMethods', 'subtotal'));
    }

    // Validates the form, saves shipping address and order details, then redirects to payment
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:63',
            'surname' => 'required|string|max:63',
            'email' => 'required|email|max:127',
            'phone_number' => 'required|string|max:31',
            'street_address' => 'required|string|max:255',
            'apartment' => 'nullable|string|max:127',
            'city' => 'required|string|max:127',
            'postal_code' => 'required|string|max:15',
            'country' => 'required|string|max:127',
            'shipping_method_id' => 'required|exists:shipping_methods,id',
        ]);

        $cart = Order::with('items.product')
            ->activeCart()
            ->firstOrFail();

        $address = Address::create([
            'street_address' => $validated['street_address'],
            'apartment' => $validated['apartment'] ?? null,
            'city' => $validated['city'],
            'postal_code' => $validated['postal_code'],
            'country' => $validated['country'],
        ]);

        $shippingMethod = ShippingMethod::findOrFail($validated['shipping_method_id']);
        $subtotal = $cart->items->sum(fn($item) => $item->product->price * $item->quantity);

        $cart->update([
            'name' => $validated['name'],
            'surname' => $validated['surname'],
            'email' => $validated['email'],
            'phone_number' => $validated['phone_number'],
            'shipping_address_id' => $address->id,
            'shipping_method_id' => $shippingMethod->id,
            'sum' => $subtotal + $shippingMethod->price,
            'date' => now(),
        ]);

        return redirect('/payment');
    }
}
