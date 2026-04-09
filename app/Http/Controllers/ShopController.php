<?php

namespace App\Http\Controllers;

use App\Models\Effect;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductEffect;
use App\Models\ProductType;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['type.mainPhoto', 'type.category', 'size'])
            ->join('product_types', 'products.product_type_id', '=', 'product_types.id')
            ->select('products.*');

        // Full-text search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereILike('product_types.name', "%{$search}%")
                  ->orWhereILike('product_types.description', "%{$search}%");
            });
        }

        // Category filter
        if ($request->filled('category')) {
            $query->where('product_types.category_id', $request->category);
        }

        // Effect filter (multi-select — product must have at least one of the selected effects)
        if ($request->filled('effects')) {
            $query->whereHas('type.effects', function ($q) use ($request) {
                $q->whereIn('effect_id', $request->effects);
            });
        }

        // Strength filter (multi-select — product must have at least one effect with that strength)
        if ($request->filled('strengths')) {
            $query->whereHas('type.effects', function ($q) use ($request) {
                $q->whereIn('strength', $request->strengths);
            });
        }

        // Sorting
        match ($request->input('sort', '')) {
            'price_asc'    => $query->orderBy('products.price', 'asc'),
            'price_desc'   => $query->orderBy('products.price', 'desc'),
            'orders_asc'   => $query->orderByRaw('(SELECT COUNT(*) FROM order_items WHERE order_items.product_id = products.id) ASC'),
            'orders_desc'  => $query->orderByRaw('(SELECT COUNT(*) FROM order_items WHERE order_items.product_id = products.id) DESC'),
            'reviews_asc'  => $query->orderByRaw('(SELECT COUNT(*) FROM reviews WHERE reviews.product_type_id = products.product_type_id) ASC'),
            'reviews_desc' => $query->orderByRaw('(SELECT COUNT(*) FROM reviews WHERE reviews.product_type_id = products.product_type_id) DESC'),
            default        => null,
        };

        $products = $query->paginate(12)->withQueryString();

        // Scope sidebar filters to product types in the selected category
        $typeIds = ProductType::when($request->filled('category'),
            fn($q) => $q->where('category_id', $request->category)
        )->pluck('id');

        $effects = Effect::whereHas('productEffects', fn($q) =>
            $q->whereIn('product_type_id', $typeIds)
        )->orderBy('name')->get();

        $strengths = ProductEffect::whereIn('product_type_id', $typeIds)
            ->distinct()
            ->pluck('strength')
            ->sortBy(fn($s) => array_search($s, ['Basic', 'Greater', 'Superior', 'Supreme']))
            ->values();

        // Current category name for the page title
        $categoryName = 'All Products';
        if ($request->filled('category')) {
            $category = ProductCategory::find($request->category);
            $categoryName = $category?->name ?? 'All Products';
        }

        return view('pages.shop', compact('products', 'effects', 'strengths', 'categoryName'));
    }
}
