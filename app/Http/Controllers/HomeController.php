<?php

namespace App\Http\Controllers;

use App\Models\Product;

// Handles homepage rendering
class HomeController extends Controller
{
    public function index()
    {
        // Main offer card
        $featuredBundle = Product::with('mainPhoto')
            ->where('category_id', 5)
            ->first();

        // Side offer cards
        $sideOffers = collect();
        foreach ([3, 4] as $catId) {
            $offer = Product::with('mainPhoto')
                ->where('category_id', $catId)
                ->where('grade', 'Supreme')
                ->first();
            if ($offer) {
                $sideOffers->push($offer);
            }
        }

        // New product cards
        $newProducts = Product::with('mainPhoto')
            ->where('category_id', '!=', 5)
            ->orderByDesc('created_at')
            ->take(8)
            ->get();

        // Recommended products -> recommend products with the most orders
        $recommended = Product::with('mainPhoto')
            ->where('category_id', '!=', 5)
            ->withCount('orderItems')
            ->orderByDesc('order_items_count')
            ->take(32)
            ->get();

        return view('pages.home', compact('featuredBundle', 'sideOffers', 'newProducts', 'recommended'));
    }
}
