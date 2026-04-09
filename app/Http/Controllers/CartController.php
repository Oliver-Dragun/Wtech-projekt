<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private function getCart(): Order
    {
        $cart = Order::where('user_id', auth()->id())
            ->whereNull('status_id')
            ->first();

        if (!$cart) {
            $cart = Order::create(['user_id' => auth()->id()]);
        }

        return $cart;
    }

    public function index()
    {
        $cart = Order::with([
            'items.product.type.mainPhoto',
            'items.product.size',
        ])
        ->where('user_id', auth()->id())
        ->whereNull('status_id')
        ->first();

        $items    = $cart ? $cart->items : collect();
        $subtotal = $items->sum(fn($item) => $item->product->price * $item->quantity);

        return view('pages.cart', compact('items', 'subtotal'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1|max:99',
        ]);

        $cart     = $this->getCart();
        $quantity = (int) $request->quantity;
        $item     = $cart->items()->where('product_id', $request->product_id)->first();

        if ($item) {
            $item->update(['quantity' => min(99, $item->quantity + $quantity)]);
        } else {
            $cart->items()->create([
                'product_id' => (int) $request->product_id,
                'quantity'   => $quantity,
            ]);
        }

        return redirect()->back()->with('success', 'Added to cart.');
    }

    public function updateItem(Request $request, int $id)
    {
        $item = OrderItem::where('id', $id)
            ->whereHas('order', fn($q) => $q->where('user_id', auth()->id())->whereNull('status_id'))
            ->firstOrFail();

        $action   = $request->input('action');
        $quantity = (int) $item->quantity;

        if ($action === 'remove') {
            $item->delete();
        } elseif ($action === 'increase') {
            $item->update(['quantity' => min(99, $quantity + 1)]);
        } elseif ($action === 'decrease') {
            if ($quantity > 1) {
                $item->update(['quantity' => $quantity - 1]);
            }
        } elseif ($request->filled('quantity')) {
            $request->validate(['quantity' => 'integer|min:1|max:99']);
            $item->update(['quantity' => (int) $request->quantity]);
        }

        return redirect()->route('cart.index');
    }
}
