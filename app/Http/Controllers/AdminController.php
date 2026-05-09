<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// Handles admin CRUD
class AdminController extends Controller
{
    private const GRADES = ['Basic', 'Greater', 'Superior', 'Supreme'];
    private const UPLOAD_DIR = 'images/product-images/uploaded';

    // Renders product list with paging and the option to add filters
    public function index(Request $request)
    {
        $query = Product::with('mainPhoto');

        if ($request->filled('search')) {
            $query->search($request->search);
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $products = $query->orderBy('id')->paginate(20)->withQueryString();
        $categories = ProductCategory::orderBy('name')->get();

        return view('pages.admin', compact('products', 'categories'));
    }

    // Renders the add product form, ('product' => null) means it opens in add mode, not edit
    public function create()
    {
        return view('pages.admin-product-form', [
            'product'    => null,
            'categories' => ProductCategory::orderBy('name')->get(),
            'grades'     => self::GRADES,
        ]);
    }

    // POST /admin/products — handles the Add form submission.
    public function store(Request $request)
    {
        // Validate text fields and uploaded images
        $data = $this->validateProduct($request);

        // Insert new product and images, if it fails everything is rolled back
        $product = DB::transaction(function () use ($data, $request) {
            $product = Product::create([
                'name'        => $data['name'],
                'description' => $data['description'],
                'category_id' => $data['category_id'],
                'effect'      => $data['effect'],
                'grade'       => $data['grade'],
                'price'       => $data['price'],
                'created_at'  => now(),
            ]);

            if ($request->hasFile('photos')) {
                $this->saveUploadedPhotos($product, $request->file('photos'), startNumber: 0);
            }

            return $product;
        });

        return redirect('/admin')->with('status', "Product \"{$product->name}\" created.");
    }

    // Renders product for in edit mode ('product' => $product)
    public function edit(Product $product)
    {
        $product->load('photos');

        return view('pages.admin-product-form', [
            'product'    => $product,
            'categories' => ProductCategory::orderBy('name')->get(),
            'grades'     => self::GRADES,
        ]);
    }

    // Applies edits from edit form
    public function update(Request $request, Product $product)
    {
        $data = $this->validateProduct($request);

       // Update db, delete marked photos and add new photos
        DB::transaction(function () use ($data, $request, $product) {
            // Step 1: update the products row itself.
            $product->update([
                'name'        => $data['name'],
                'description' => $data['description'],
                'category_id' => $data['category_id'],
                'effect'      => $data['effect'],
                'grade'       => $data['grade'],
                'price'       => $data['price'],
            ]);

            $removeIds = collect($request->input('remove_photos', []))->map('intval')->all();
            if (!empty($removeIds)) {
                $toRemove = $product->photos()->whereIn('id', $removeIds)->get();
                foreach ($toRemove as $photo) {
                    $this->deletePhotoFile($photo->img);
                    $photo->delete();
                }
            }

            $remaining = $product->photos()->count();
            if ($request->hasFile('photos')) {
                $this->saveUploadedPhotos($product, $request->file('photos'), startNumber: $remaining);
            }

            $this->renumberPhotos($product);
        });

        return redirect('/admin')->with('status', "Product \"{$product->name}\" updated.");
    }

    // Deletes product from db, does not delete initial photos from the seed 
    public function destroy(Product $product)
    {
        DB::transaction(function () use ($product) {
            foreach ($product->photos as $photo) {
                $this->deletePhotoFile($photo->img);
                $photo->delete();
            }
            $product->delete();
        });

        return redirect('/admin')->with('status', "Product \"{$product->name}\" deleted.");
    }

    private function validateProduct(Request $request): array
    {
        return $request->validate([
            'name'           => 'required|string|max:255',
            'description'    => 'required|string',
            'category_id'    => 'required|exists:product_categories,id',
            'effect'         => 'required|string|max:63',
            'grade'          => 'required|in:' . implode(',', self::GRADES),
            'price'          => 'required|integer|min:0',
            'photos.*'       => 'image|mimes:jpg,jpeg,png,webp,gif|max:4096',
            'remove_photos.*'=> 'integer',
        ]);
    }

    // Move uploaded photos into 'images/product-images/uploaded', register them in db and link to product
    private function saveUploadedPhotos(Product $product, array $files, int $startNumber): void
    {
        $absoluteDir = public_path(self::UPLOAD_DIR);
        
        // Creates 'images/product-images/uploaded' if it does not exist
        if (!is_dir($absoluteDir)) {
            mkdir($absoluteDir, 0775, true);
        }

        foreach ($files as $i => $file) {
            // Create filename
            $ext = strtolower($file->getClientOriginalExtension() ?: 'png');
            $name = 'p' . $product->id . '_' . uniqid() . '.' . $ext;
            $file->move($absoluteDir, $name);

            ProductPhoto::create([
                'product_id' => $product->id,
                'number'     => $startNumber + $i,
                'img'        => self::UPLOAD_DIR . '/' . $name,
            ]);
        }
    }

   // Remove uploaded photo from 'images/product-images/uploaded'
    private function deletePhotoFile(string $relativePath): void
    {
        if (!str_starts_with($relativePath, self::UPLOAD_DIR . '/')) {
            return;
        }
        $absolute = public_path($relativePath);
        if (is_file($absolute)) {
            @unlink($absolute);
        }
    }

    // Update photo numbers afterr adding/removing photos
    private function renumberPhotos(Product $product): void
    {
        $photos = $product->photos()->orderBy('number')->orderBy('id')->get();
        foreach ($photos as $i => $photo) {
            if ($photo->number !== $i) {
                $photo->update(['number' => $i]);
            }
        }
    }
}
