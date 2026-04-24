<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

// Handles the shop listing page and product search
class ShopController extends Controller
{
    // Returns paginated products with filters and sorting applied
    public function index(Request $request)
    {
        $query = Product::with('mainPhoto');

        if ($request->filled('search')) {
            $query->search($request->search);
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('effects')) {
            $query->whereIn('effect', $request->effects);
        }

        if ($request->filled('grades')) {
            $query->whereIn('grade', $request->grades);
        }

        if ($request->filled('price_min')) {
            $query->where('price', '>=', (int) $request->price_min);
        }
        if ($request->filled('price_max')) {
            $query->where('price', '<=', (int) $request->price_max);
        }

        match ($request->input('sort', '')) {
            'price_asc' => $query->orderBy('price', 'asc'),
            'price_desc' => $query->orderBy('price', 'desc'),
            'orders_asc' => $query->orderByRaw('(SELECT COUNT(*) FROM order_items WHERE order_items.product_id = products.id) ASC'),
            'orders_desc' => $query->orderByRaw('(SELECT COUNT(*) FROM order_items WHERE order_items.product_id = products.id) DESC'),
            'reviews_asc' => $query->orderByRaw('(SELECT COUNT(*) FROM reviews WHERE reviews.product_id = products.id) ASC'),
            'reviews_desc' => $query->orderByRaw('(SELECT COUNT(*) FROM reviews WHERE reviews.product_id = products.id) DESC'),
            default => null,
        };

        $products = $query->paginate(12)->withQueryString();

        $scopedQuery = Product::query();
        if ($request->filled('category')) {
            $scopedQuery->where('category_id', $request->category);
        }

        $effects = (clone $scopedQuery)->distinct()->orderBy('effect')->pluck('effect');

        $grades = (clone $scopedQuery)->distinct()->pluck('grade')
            ->sortBy(fn($g) => array_search($g, ['Basic', 'Greater', 'Superior', 'Supreme']))
            ->values();

        $categoryName = 'All Products';
        if ($request->filled('category')) {
            $category = ProductCategory::find($request->category);
            $categoryName = $category?->name ?? 'All Products';
        }

        return view('pages.shop', compact('products', 'effects', 'grades', 'categoryName'));
    }

    // Returns up to 5 product suggestions for the search dropdown
    public function search(Request $request)
    {
        $search = $request->input('q', '');

        if (strlen($search) < 1) {
            return response()->json([]);
        }

        $results = Product::with('mainPhoto')
            ->search($search)
            ->whereIn('id', function ($q) use ($search) {
                $q->selectRaw('MIN(id)')
                    ->from('products')
                    ->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($search) . '%'])
                    ->groupBy('name');
            })
            ->limit(5)
            ->get()
            ->map(fn($product) => [
                'id' => $product->id,
                'name' => $product->name,
                'image' => $product->mainPhoto?->img,
                'product_id' => $product->id,
            ]);

        return response()->json($results);
    }
}
