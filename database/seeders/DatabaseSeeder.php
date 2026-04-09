<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            // Independent tables first
            ProductCategorySeeder::class,
            EffectSeeder::class,
            SizeSeeder::class,
            ShippingMethodSeeder::class,
            OrderStatusSeeder::class,

            // Depends on categories
            ProductTypeSeeder::class,

            // Depends on product types and sizes
            ProductSeeder::class,

            // Depends on product types
            ProductPhotoSeeder::class,
            ProductEffectSeeder::class,
        ]);
    }
}
