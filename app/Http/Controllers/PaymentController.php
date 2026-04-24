<?php

namespace App\Http\Controllers;

use App\Models\Order;

// Handles the payment page and order confirmation
class PaymentController extends Controller
{
    // Shows the payment form for the current pending order
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

    // Confirms the order and fills any missing user profile fields from order data
    public function store()
    {
        $order = Order::with('shippingAddress')
            ->activeCart()
            ->whereNotNull('shipping_address_id')
            ->firstOrFail();

        $order->update(['status_id' => 1]);

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
