<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use App\Models\Product;
use App\Models\ShippingMethod;
use Illuminate\Http\Request;

// Handles checkout
class CheckoutController extends Controller
{
    // Renders checkout page from the user's cart or session cart
    public function index()
    {
        $shippingMethods = ShippingMethod::all();

        if (auth()->check()) {
            $cart = Order::with(['items.product.mainPhoto'])
                ->activeCart()
                ->first();

            if (!$cart || $cart->items->isEmpty()) {
                return redirect()->route('cart.index');
            }

            $subtotal = $cart->items->sum(fn($item) => $item->product->price * $item->quantity);
        } else {
            $sessionCart = session('cart', []);

            if (empty($sessionCart)) {
                return redirect()->route('cart.index');
            }

            $products = Product::with('mainPhoto')
                ->whereIn('id', array_keys($sessionCart))
                ->get()
                ->keyBy('id');

            $items = collect($sessionCart)->map(fn($qty, $productId) => (object)[
                'product'  => $products[$productId],
                'quantity' => $qty,
            ]);

            $cart = (object)['items' => $items];
            $subtotal = $items->sum(fn($item) => $item->product->price * $item->quantity);
        }

        return view('pages.checkout', compact('cart', 'shippingMethods', 'subtotal'));
    }

    // Validates checkout info, saves to DB cart or creates guest order
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'               => 'required|string|max:63',
            'surname'            => 'required|string|max:63',
            'email'              => 'required|email|max:127',
            'phone_number'       => 'required|string|max:31',
            'street_address'     => 'required|string|max:255',
            'apartment'          => 'nullable|string|max:127',
            'city'               => 'required|string|max:127',
            'postal_code'        => 'required|string|max:15',
            'country'            => 'required|string|max:127',
            'shipping_method_id' => 'required|exists:shipping_methods,id',
        ]);

        $address = Address::create([
            'street_address' => $validated['street_address'],
            'apartment'      => $validated['apartment'] ?? null,
            'city'           => $validated['city'],
            'postal_code'    => $validated['postal_code'],
            'country'        => $validated['country'],
        ]);

        $shippingMethod = ShippingMethod::findOrFail($validated['shipping_method_id']);

        if (auth()->check()) {
            $cart = Order::with('items.product')->activeCart()->firstOrFail();
            $subtotal = $cart->items->sum(fn($item) => $item->product->price * $item->quantity);

            $cart->update([
                'name'                => $validated['name'],
                'surname'             => $validated['surname'],
                'email'               => $validated['email'],
                'phone_number'        => $validated['phone_number'],
                'shipping_address_id' => $address->id,
                'shipping_method_id'  => $shippingMethod->id,
                'sum'                 => $subtotal + $shippingMethod->price,
                'date'                => now(),
            ]);
        } else {
            $sessionCart = session('cart', []);

            if (empty($sessionCart)) {
                return redirect()->route('cart.index');
            }

            $products = Product::whereIn('id', array_keys($sessionCart))->get()->keyBy('id');
            $subtotal = collect($sessionCart)->sum(fn($qty, $productId) => $products[$productId]->price * $qty);

            $order = Order::create([
                'user_id'             => null,
                'name'                => $validated['name'],
                'surname'             => $validated['surname'],
                'email'               => $validated['email'],
                'phone_number'        => $validated['phone_number'],
                'shipping_address_id' => $address->id,
                'shipping_method_id'  => $shippingMethod->id,
                'sum'                 => $subtotal + $shippingMethod->price,
                'date'                => now(),
            ]);

            foreach ($sessionCart as $productId => $quantity) {
                $order->items()->create([
                    'product_id' => $productId,
                    'quantity'   => $quantity,
                ]);
            }

            session(['guest_order_id' => $order->id]);
            session()->forget('cart');
        }

        return redirect('/payment');
    }
}
