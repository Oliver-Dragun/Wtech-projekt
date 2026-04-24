<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

// Shows a single product page with reviews and recommendations
class ProductController extends Controller
{
    public function show(int $id)
    {
        $product = Product::with([
            'photos',
            'category',
            'reviews.user',
        ])->findOrFail($id);

        $recommended = Product::with('mainPhoto')
            ->where('id', '!=', $id)
            ->where('is_bundle', false)
            ->withCount('orderItems')
            ->orderByDesc('order_items_count')
            ->limit(32)
            ->get();

        $userReview = auth()->check()
            ? $product->reviews->firstWhere('user_id', auth()->id())
            : null;

        return view('pages.product', compact('product', 'recommended', 'userReview'));
    }
}
