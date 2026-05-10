<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

// Cart logic
class CartController extends Controller
{
    private function getSessionCart(): array
    {
        return session('cart', []);
    }

    private function saveSessionCart(array $cart): void
    {
        session(['cart' => $cart]);
    }

    // Returns logged in user's cart
    private function getDbCart(): Order
    {
        $cart = Order::activeCart()->first();

        if (!$cart) {
            $cart = Order::create(['user_id' => auth()->id()]);
        }

        return $cart;
    }

    // Merge guest session cart with logged in user's cart
    public static function mergeGuestCart(): void
    {
        $sessionCart = session('cart', []);

        if (empty($sessionCart)) {
            return;
        }

        $cart = Order::activeCart()->first() ?? Order::create(['user_id' => auth()->id()]);

        foreach ($sessionCart as $productId => $quantity) {
            $item = $cart->items()->where('product_id', $productId)->first();

            // If the item already is in the logged in cart, the quantity from the guest cart is added
            if ($item) {
                $item->update(['quantity' => min(99, $item->quantity + $quantity)]);
            } else {
                $cart->items()->create([
                    'product_id' => (int) $productId,
                    'quantity' => (int) $quantity,
                ]);
            }
        }

        session()->forget('cart');
    }

    // Render cart page
    public function index()
    {
        if (auth()->check()) {
            $cart = Order::with(['items.product.mainPhoto'])
                ->activeCart()
                ->first();

            $items = $cart ? $cart->items : collect();
        } else {
            // For guests (not logged in) generates a 'items' list since it is not saved in the db, only session
            $sessionCart = $this->getSessionCart();

            $products = Product::with('mainPhoto')
                ->whereIn('id', array_keys($sessionCart))
                ->get()
                ->keyBy('id');

            $items = collect($sessionCart)->map(fn($qty, $pid) => (object) [
                'product_id' => (int) $pid,
                'product' => $products->get($pid),
                'quantity' => (int) $qty,
            ]);
        }

        $subtotal = $items->sum(fn($item) => $item->product->price * $item->quantity);

        return view('pages.cart', compact('items', 'subtotal'));
    }

    // Adds a product to the cart, has validation and seperate logic for guests and logged in users
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1|max:99',
        ]);

        $productId = (int) $request->product_id;
        $quantity = (int) $request->quantity;

        if (auth()->check()) {
            $cart = $this->getDbCart();
            $item = $cart->items()->where('product_id', $productId)->first();

            if ($item) {
                $item->update(['quantity' => min(99, $item->quantity + $quantity)]);
            } else {
                $cart->items()->create([
                    'product_id' => $productId,
                    'quantity' => $quantity,
                ]);
            }
        } else {
            $cart = $this->getSessionCart();
            $cart[$productId] = min(99, ($cart[$productId] ?? 0) + $quantity);
            $this->saveSessionCart($cart);
        }

        return redirect()->back()->with('success', 'Added to cart.');
    }

    // Allows editing quantity or removing items from cart, seperate logic for logged in and guest users
    public function updateItem(Request $request, int $productId)
    {
        $action = $request->input('action');

        if (auth()->check()) {
            $cart = Order::activeCart()->firstOrFail();

            $item = $cart->items()->where('product_id', $productId)->firstOrFail();
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
        } else {
            $cart = $this->getSessionCart();

            if ($action === 'remove' || !isset($cart[$productId])) {
                unset($cart[$productId]);
            } elseif ($action === 'increase') {
                $cart[$productId] = min(99, $cart[$productId] + 1);
            } elseif ($action === 'decrease') {
                if ($cart[$productId] > 1) {
                    $cart[$productId]--;
                }
            } elseif ($request->filled('quantity')) {
                $request->validate(['quantity' => 'integer|min:1|max:99']);
                $cart[$productId] = (int) $request->quantity;
            }

            $this->saveSessionCart($cart);
        }

        return redirect()->route('cart.index');
    }
}
