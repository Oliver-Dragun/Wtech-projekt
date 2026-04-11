<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        // Featured bundle for the hero section
        $featuredBundle = Product::with('mainPhoto')
           ->where('is_bundle', true)
           ->first();

        // Track used product names to avoid showing the same product in different grades
        $usedNames = [];

        // Two side offer products, one Orb, one Artifact (Supreme grade)
        $sideOffers = collect();
        foreach ([3, 4] as $catId) {
            $offer = Product::with('mainPhoto')
               ->where('category_id', $catId)
               ->where('is_bundle', false)
               ->where('grade', 'Supreme')
               ->first();
            if ($offer) {
                $sideOffers->push($offer);
                $usedNames[] = $offer->name;
            }
        }

        // New products, 2 from each category, unique names
        $newProducts = collect();
        foreach ([1, 2, 3, 4] as $categoryId) {
            $items = Product::with('mainPhoto')
               ->where('category_id', $categoryId)
               ->where('is_bundle', false)
               ->whereNotIn('name', $usedNames)
               ->whereIn('id', function ($q) use ($categoryId, $usedNames) {
                    $q->selectRaw('MIN(id)')
                       ->from('products')
                       ->where('category_id', $categoryId)
                       ->where('is_bundle', false)
                       ->whereNotIn('name', $usedNames)
                       ->groupBy('name')
                       ->limit(2);
                })
               ->get();
            foreach ($items as $item) {
                $usedNames[] = $item->name;
                $newProducts->push($item);
            }
        }

        // Recommended, 4 products with unique names, one per category
        $recommended = collect();
        foreach ([1, 2, 3, 4] as $categoryId) {
            $item = Product::with('mainPhoto')
               ->where('category_id', $categoryId)
               ->where('is_bundle', false)
               ->whereNotIn('name', $usedNames)
               ->first();
            if ($item) {
                $usedNames[] = $item->name;
                $recommended->push($item);
            }
        }

        return view('pages.home', compact('featuredBundle', 'sideOffers', 'newProducts', 'recommended'));
    }
}
