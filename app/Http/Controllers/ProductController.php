<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show(int $id)
    {
        $product = Product::with([
            'type.photos',
            'type.category',
            'type.effects.effect',
            'type.reviews',
            'size',
        ])->findOrFail($id);

        // 4 products from the same category, different type, sorted by price
        $recommended = Product::with(['type.mainPhoto', 'size'])
            ->join('product_types', 'products.product_type_id', '=', 'product_types.id')
            ->where('product_types.category_id', $product->type->category_id)
            ->where('products.product_type_id', '!=', $product->product_type_id)
            ->select('products.*')
            ->orderBy('products.price')
            ->limit(4)
            ->get();

        return view('pages.product', compact('product', 'recommended'));
    }
}
