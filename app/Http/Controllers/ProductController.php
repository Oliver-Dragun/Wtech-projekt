<?php

namespace App\Http\Controllers;

use App\Models\Product;

// Product detail page
class ProductController extends Controller
{
    // Renders the product detail page
    public function show(int $id)
    {
        // Product info
        $product = Product::with([
            'photos',
            'category',
            'reviews.user',
        ])->findOrFail($id);

        // Recommendations
        $recommended = Product::with('mainPhoto')
            ->where('id', '!=', $id)
            ->where('category_id', '!=', 5)
            ->withCount('orderItems')
            ->orderByDesc('order_items_count')
            ->limit(32)
            ->get();

        // User's review if they already reviewed this product
        $userReview = auth()->check()
            ? $product->reviews->firstWhere('user_id', auth()->id())
            : null;

        return view('pages.product', compact('product', 'recommended', 'userReview'));
    }
}
