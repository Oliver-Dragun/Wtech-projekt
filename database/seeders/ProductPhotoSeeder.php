<?php

namespace Database\Seeders;

use App\Models\ProductPhoto;
use Illuminate\Database\Seeder;

class ProductPhotoSeeder extends Seeder
{
    public function run(): void
    {
        // photo_id references product_types.id
        // number = display order (1 = main photo)
        $photos = [
            // Healing Potion — has dedicated detail shots
            ['photo_id' => 1, 'number' => 1, 'img' => 'images/product-images/healing-potion/healing-potion-product-1.png'],
            ['photo_id' => 1, 'number' => 2, 'img' => 'images/product-images/healing-potion/healing-potion-product-2.png'],
            ['photo_id' => 1, 'number' => 3, 'img' => 'images/product-images/healing-potion/healing-potion-product-3.png'],

            // All other types — single thumbnail for now
            ['photo_id' => 2, 'number' => 1, 'img' => 'images/potion-images/speed-potion.png'],
            ['photo_id' => 3, 'number' => 1, 'img' => 'images/potion-images/fireresistance-potion.png'],
            ['photo_id' => 4, 'number' => 1, 'img' => 'images/potion-images/restoration-potion.png'],
            ['photo_id' => 5, 'number' => 1, 'img' => 'images/potion-images/mana-potion.png'],
            ['photo_id' => 6, 'number' => 1, 'img' => 'images/potion-images/invisibility-potion.png'],
            ['photo_id' => 7, 'number' => 1, 'img' => 'images/potion-images/strength-potion.png'],
            ['photo_id' => 8, 'number' => 1, 'img' => 'images/potion-images/fortitude-potion.png'],
        ];

        foreach ($photos as $photo) {
            ProductPhoto::create($photo);
        }
    }
}
