<?php

namespace App\Http\Controllers;

use App\Models\Order;

// Handles payment, no real card validation
class PaymentController extends Controller
{
    // Renders payment, if the cart was not checked out -> redirect to checkout
    public function index()
    {
        $order = Order::activeCart()
            ->whereNotNull('shipping_address_id')
            ->first();

        if (!$order) {
            return redirect('/checkout');
        }

        return view('pages.payment', compact('order'));
    }

    // Creates order -> status_id is set
    public function store()
    {
        $order = Order::with('shippingAddress')
            ->activeCart()
            ->whereNotNull('shipping_address_id')
            ->firstOrFail();

        // Mark order as pending -> next time user adds item, it creates a new cart
        $order->update(['status_id' => 1]);

        // Save user data if they were logged in for future order autofill
        $user = auth()->user();
        $userFill = [];
        if (is_null($user->phone_number) && $order->phone_number) {
            $userFill['phone_number'] = $order->phone_number;
        }
        if (is_null($user->address_id) && $order->shipping_address_id) {
            $userFill['address_id'] = $order->shipping_address_id;
        }
        if ($userFill) {
            $user->update($userFill);
        }

        return redirect('/profile');
    }
}
