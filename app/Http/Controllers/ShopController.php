<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('mainPhoto');

        // Full-text search
        if ($request->filled('search')) {
            $lower = strtolower($request->search);
            $query->whereRaw('LOWER(name) LIKE ?', ["%{$lower}%"]);
        }

        // Category filter
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Effect filter (multi-select)
        if ($request->filled('effects')) {
            $query->whereIn('effect', $request->effects);
        }

        // Grade filter (multi-select)
        if ($request->filled('grades')) {
            $query->whereIn('grade', $request->grades);
        }

        // Price range filter
        if ($request->filled('price_min')) {
            $query->where('price', '>=', (int) $request->price_min);
        }
        if ($request->filled('price_max')) {
            $query->where('price', '<=', (int) $request->price_max);
        }

        // Sorting
        match ($request->input('sort', '')) {
            'price_asc'    => $query->orderBy('price', 'asc'),
            'price_desc'   => $query->orderBy('price', 'desc'),
            'orders_asc'   => $query->orderByRaw('(SELECT COUNT(*) FROM order_items WHERE order_items.product_id = products.id) ASC'),
            'orders_desc'  => $query->orderByRaw('(SELECT COUNT(*) FROM order_items WHERE order_items.product_id = products.id) DESC'),
            'reviews_asc'  => $query->orderByRaw('(SELECT COUNT(*) FROM reviews WHERE reviews.product_id = products.id) ASC'),
            'reviews_desc' => $query->orderByRaw('(SELECT COUNT(*) FROM reviews WHERE reviews.product_id = products.id) DESC'),
            default        => null,
        };

        $products = $query->paginate(12)->withQueryString();

        // Scope sidebar filters to the selected category
        $scopedQuery = Product::query();
        if ($request->filled('category')) {
            $scopedQuery->where('category_id', $request->category);
        }

        $effects = (clone $scopedQuery)->distinct()->orderBy('effect')->pluck('effect');

        $grades = (clone $scopedQuery)->distinct()->pluck('grade')
            ->sortBy(fn($g) => array_search($g, ['Basic', 'Greater', 'Superior', 'Supreme']))
            ->values();

        // Current category name for the page title
        $categoryName = 'All Products';
        if ($request->filled('category')) {
            $category = ProductCategory::find($request->category);
            $categoryName = $category?->name ?? 'All Products';
        }

        return view('pages.shop', compact('products', 'effects', 'grades', 'categoryName'));
    }

    public function search(Request $request)
    {
        $search = $request->input('q', '');

        if (strlen($search) < 1) {
            return response()->json([]);
        }

        $results = Product::with('mainPhoto')
            ->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($search) . '%'])
            ->whereIn('id', function ($q) use ($search) {
                $q->selectRaw('MIN(id)')
                    ->from('products')
                    ->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($search) . '%'])
                    ->groupBy('name');
            })
            ->limit(5)
            ->get()
            ->map(fn($product) => [
                'id'         => $product->id,
                'name'       => $product->name,
                'image'      => $product->mainPhoto?->img,
                'product_id' => $product->id,
            ]);

        return response()->json($results);
    }
}
