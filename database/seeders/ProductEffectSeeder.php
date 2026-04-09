<?php

namespace Database\Seeders;

use App\Models\ProductEffect;
use Illuminate\Database\Seeder;

class ProductEffectSeeder extends Seeder
{
    public function run(): void
    {
        // effect_id references effects.id (1–8 matching seeder order)
        // product_type_id references product_types.id (1–8)
        // strength: Basic | Greater | Superior | Supreme
        $effects = [
            ['effect_id' => 1, 'product_type_id' => 1, 'strength' => 'Superior'],  // Healing on Healing Potion
            ['effect_id' => 8, 'product_type_id' => 1, 'strength' => 'Basic'],     // Restoration on Healing Potion

            ['effect_id' => 2, 'product_type_id' => 2, 'strength' => 'Superior'],  // Speed on Speed Potion

            ['effect_id' => 4, 'product_type_id' => 3, 'strength' => 'Supreme'],   // Fire Resistance on Fire Resistance Potion

            ['effect_id' => 8, 'product_type_id' => 4, 'strength' => 'Superior'],  // Restoration on Restoration Potion
            ['effect_id' => 1, 'product_type_id' => 4, 'strength' => 'Basic'],     // Healing on Restoration Potion

            ['effect_id' => 3, 'product_type_id' => 5, 'strength' => 'Superior'],  // Mana Restoration on Mana Potion

            ['effect_id' => 5, 'product_type_id' => 6, 'strength' => 'Supreme'],   // Invisibility on Invisibility Potion

            ['effect_id' => 6, 'product_type_id' => 7, 'strength' => 'Superior'],  // Strength on Strength Potion

            ['effect_id' => 7, 'product_type_id' => 8, 'strength' => 'Superior'],  // Fortitude on Fortitude Potion
            ['effect_id' => 6, 'product_type_id' => 8, 'strength' => 'Basic'],     // Strength on Fortitude Potion
        ];

        foreach ($effects as $effect) {
            ProductEffect::create($effect);
        }
    }
}
