<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;

// Handles product reviews
class ReviewController extends Controller
{
    // Creates a review and redirects back to the product detail page
    public function store(Request $request)
    {
        // Get product id for redirect path
        $productId = (int) $request->input('product_id');

        try {
            $validated = $request->validate([
                'product_id' => 'required|integer|exists:products,id',
                'rating' => 'required|integer|min:1|max:5',
                'body' => 'required|string|min:3|max:1000',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect('/product/' . $productId . '#reviews')
                ->withErrors($e->errors())
                ->withInput();
        }

        $userId = auth()->id();

        // Ensure only one review per product per user
        $already = Review::where('user_id', $userId)
            ->where('product_id', $validated['product_id'])
            ->exists();

        if ($already) {
            return redirect('/product/' . $validated['product_id'] . '#reviews')
                ->with('review_error', 'You have already reviewed this product.');
        }

        
        // Insert new review
        Review::create([
            'user_id' => $userId,
            'product_id' => $validated['product_id'],
            'rating' => $validated['rating'],
            'body' => $validated['body'],
            'date' => now(),
        ]);

        return redirect('/product/' . $validated['product_id'] . '#reviews');
    }
}
