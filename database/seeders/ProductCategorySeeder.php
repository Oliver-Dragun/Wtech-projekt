<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = ['Potions', 'Scrolls', 'Orbs', 'Artifacts', 'Bundles'];

        foreach ($categories as $name) {
            ProductCategory::create(['name' => $name]);
        }
    }
}
