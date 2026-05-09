<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

// Handles the shop page and search bar in the header
class ShopController extends Controller
{
    // Renders the store page catalogue based on filter, all filters are applied sequentially
    public function index(Request $request)
    {
        $query = Product::with('mainPhoto');

        // Filter by search if search is filled
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Filter by effect
        if ($request->filled('effects')) {
            $query->whereIn('effect', $request->effects);
        }

        // Filter by grade
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

        // Sort results
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

        // Efects and categories for the sidebar
        $scopedQuery = Product::query();
        if ($request->filled('category')) {
            $scopedQuery->where('category_id', $request->category);
        }

        $effects = (clone $scopedQuery)->distinct()->orderBy('effect')->pluck('effect');

        $grades = (clone $scopedQuery)->distinct()->pluck('grade')
            ->sortBy(fn($g) => array_search($g, ['Basic', 'Greater', 'Superior', 'Supreme']))
            ->values();

        // Page title based on selected category
        $categoryName = 'All Products';
        if ($request->filled('category')) {
            $category = ProductCategory::find($request->category);
            $categoryName = $category?->name ?? 'All Products';
        }

        return view('pages.shop', compact('products', 'effects', 'grades', 'categoryName'));
    }

    // Returns the matches of searched product name with debounce from the search bar
    public function search(Request $request)
    {
        $search = $request->input('q', '');

        if (strlen($search) < 1) {
            return response()->json([]);
        }

        // Each product only apears once even when it has multiple entries with different grades
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
