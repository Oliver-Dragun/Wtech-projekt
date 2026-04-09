<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Each product type (1–8) gets 4 size variants
        // size_id: 1=Small, 2=Medium, 3=Large, 4=Greater
        // Prices scale with size
        $basePrices = [
            1 => 25,  // Healing Potion
            2 => 30,  // Speed Potion
            3 => 40,  // Fire Resistance
            4 => 35,  // Restoration
            5 => 20,  // Mana Potion
            6 => 50,  // Invisibility
            7 => 45,  // Strength
            8 => 55,  // Fortitude
        ];

        $sizeMultipliers = [1 => 1.0, 2 => 1.5, 3 => 2.0, 4 => 2.5];

        foreach ($basePrices as $typeId => $basePrice) {
            foreach ($sizeMultipliers as $sizeId => $multiplier) {
                Product::create([
                    'product_type_id' => $typeId,
                    'size_id'         => $sizeId,
                    'price'           => (int) round($basePrice * $multiplier),
                    'is_bundle'       => false,
                ]);
            }
        }
    }
}
