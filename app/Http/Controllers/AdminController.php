<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('mainPhoto');

        if ($request->filled('search')) {
            $lower = strtolower($request->search);
            $query->whereRaw('LOWER(name) LIKE ?', ["%{$lower}%"]);
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $products = $query->orderBy('id')->paginate(20)->withQueryString();
        $categories = ProductCategory::orderBy('name')->get();

        return view('pages.admin', compact('products', 'categories'));
    }
}
