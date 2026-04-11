<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            // Independent tables
            ProductCategorySeeder::class,
            ShippingMethodSeeder::class,
            OrderStatusSeeder::class,

            // Depends on categories
            ProductSeeder::class,

            // Depends on products
            ProductPhotoSeeder::class,

            // Admin user
            AdminSeeder::class,
        ]);
    }
}
