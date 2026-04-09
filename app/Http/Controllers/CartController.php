<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // -------------------------------------------------------------------------
    // Guest (session) helpers
    // -------------------------------------------------------------------------

    private function getSessionCart(): array
    {
        return session('cart', []);
    }

    private function saveSessionCart(array $cart): void
    {
        session(['cart' => $cart]);
    }

    // -------------------------------------------------------------------------
    // Auth (DB) helpers
    // -------------------------------------------------------------------------

    private function getDbCart(): Order
    {
        $cart = Order::where('user_id', auth()->id())
            ->whereNull('status_id')
            ->first();

        if (!$cart) {
            $cart = Order::create(['user_id' => auth()->id()]);
        }

        return $cart;
    }

    // -------------------------------------------------------------------------
    // Merge session cart into DB cart on login / register
    // -------------------------------------------------------------------------

    public static function mergeGuestCart(): void
    {
        $sessionCart = session('cart', []);

        if (empty($sessionCart)) {
            return;
        }

        $cart = Order::where('user_id', auth()->id())
            ->whereNull('status_id')
            ->first() ?? Order::create(['user_id' => auth()->id()]);

        foreach ($sessionCart as $productId => $quantity) {
            $item = $cart->items()->where('product_id', $productId)->first();

            if ($item) {
                $item->update(['quantity' => min(99, $item->quantity + $quantity)]);
            } else {
                $cart->items()->create([
                    'product_id' => (int) $productId,
                    'quantity'   => (int) $quantity,
                ]);
            }
        }

        session()->forget('cart');
    }

    // -------------------------------------------------------------------------
    // Controller actions
    // -------------------------------------------------------------------------

    public function index()
    {
        if (auth()->check()) {
            $cart  = Order::with(['items.product.type.mainPhoto', 'items.product.size'])
                ->where('user_id', auth()->id())
                ->whereNull('status_id')
                ->first();

            $items = $cart ? $cart->items : collect();
        } else {
            $sessionCart = $this->getSessionCart();

            $products = Product::with(['type.mainPhoto', 'size'])
                ->whereIn('id', array_keys($sessionCart))
                ->get()
                ->keyBy('id');

            $items = collect($sessionCart)->map(fn($qty, $pid) => (object) [
                'product_id' => (int) $pid,
                'product'    => $products->get($pid),
                'quantity'   => (int) $qty,
            ]);
        }

        $subtotal = $items->sum(fn($item) => $item->product->price * $item->quantity);

        return view('pages.cart', compact('items', 'subtotal'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1|max:99',
        ]);

        $productId = (int) $request->product_id;
        $quantity  = (int) $request->quantity;

        if (auth()->check()) {
            $cart = $this->getDbCart();
            $item = $cart->items()->where('product_id', $productId)->first();

            if ($item) {
                $item->update(['quantity' => min(99, $item->quantity + $quantity)]);
            } else {
                $cart->items()->create([
                    'product_id' => $productId,
                    'quantity'   => $quantity,
                ]);
            }
        } else {
            $cart = $this->getSessionCart();
            $cart[$productId] = min(99, ($cart[$productId] ?? 0) + $quantity);
            $this->saveSessionCart($cart);
        }

        return redirect()->back()->with('success', 'Added to cart.');
    }

    public function updateItem(Request $request, int $productId)
    {
        $action = $request->input('action');

        if (auth()->check()) {
            $cart = Order::where('user_id', auth()->id())
                ->whereNull('status_id')
                ->firstOrFail();

            $item     = $cart->items()->where('product_id', $productId)->firstOrFail();
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
