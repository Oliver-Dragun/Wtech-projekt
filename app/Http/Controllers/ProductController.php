<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show(int $id)
    {
        $product = Product::with([
            'photos',
            'category',
            'reviews',
        ])->findOrFail($id);

        // 4 products from the same category, sorted by price
        $recommended = Product::with('mainPhoto')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->orderBy('price')
            ->limit(4)
            ->get();

        return view('pages.product', compact('product', 'recommended'));
    }
}
