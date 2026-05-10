<?php

namespace App\Http\Controllers;

use App\Models\Order;

// Handles payment, no real card validation
class PaymentController extends Controller
{
    // Renders payment page — finds order by active cart or guest_order_id session
    public function index()
    {
        if (auth()->check()) {
            $order = Order::activeCart()
                ->whereNotNull('shipping_address_id')
                ->first();
        } else {
            $orderId = session('guest_order_id');
            $order = $orderId
                ? Order::whereNull('user_id')
                    ->whereNull('status_id')
                    ->whereNotNull('shipping_address_id')
                    ->where('id', $orderId)
                    ->first()
                : null;
        }

        if (!$order) {
            return redirect('/checkout');
        }

        return view('pages.payment', compact('order'));
    }

    // Confirms order — sets status_id, saves user data (auth only), clears guest session
    public function store()
    {
        if (auth()->check()) {
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

        $orderId = session('guest_order_id');
        $order = Order::whereNull('user_id')
            ->whereNull('status_id')
            ->whereNotNull('shipping_address_id')
            ->where('id', $orderId ?? 0)
            ->firstOrFail();

        $order->update(['status_id' => 1]);
        session()->forget('guest_order_id');

        return redirect('/');
    }
}
