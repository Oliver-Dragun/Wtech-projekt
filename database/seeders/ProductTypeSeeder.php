<?php

namespace Database\Seeders;

use App\Models\ProductType;
use Illuminate\Database\Seeder;

class ProductTypeSeeder extends Seeder
{
    public function run(): void
    {
        // category_id 1 = Potions
        $types = [
            [
                'name'        => 'Healing Potion',
                'description' => 'A vivid red potion brewed from crimson herbs and moonwater. Instantly restores vitality and closes minor wounds. A staple in every adventurer\'s pack.',
                'category_id' => 1,
            ],
            [
                'name'        => 'Speed Potion',
                'description' => 'A shimmering golden liquid distilled from swiftroot and lightning beetle wings. Grants the drinker unnatural agility and reflexes for a short time.',
                'category_id' => 1,
            ],
            [
                'name'        => 'Fire Resistance Potion',
                'description' => 'A thick orange brew infused with salamander scales and volcanic ash. Grants temporary immunity to heat and flame-based attacks.',
                'category_id' => 1,
            ],
            [
                'name'        => 'Restoration Potion',
                'description' => 'A deep violet elixir combining restorative herbs and purified spring water. Removes fatigue, restores stamina, and clears minor ailments.',
                'category_id' => 1,
            ],
            [
                'name'        => 'Mana Potion',
                'description' => 'A glowing blue potion condensed from arcane crystals and starlight essence. Rapidly replenishes magical energy, favoured by mages and sorcerers.',
                'category_id' => 1,
            ],
            [
                'name'        => 'Invisibility Potion',
                'description' => 'A colourless liquid with a faint shimmer, brewed from ghost orchid extract and shadow moss. Makes the drinker completely invisible for several minutes.',
                'category_id' => 1,
            ],
            [
                'name'        => 'Strength Potion',
                'description' => 'A dark red potion packed with iron root and giant\'s marrow. Temporarily doubles the drinker\'s physical power, ideal before heavy combat.',
                'category_id' => 1,
            ],
            [
                'name'        => 'Fortitude Potion',
                'description' => 'A murky brown brew made from stonebark and iron lichen. Hardens the skin and fortifies the body against physical damage for a limited duration.',
                'category_id' => 1,
            ],
        ];

        foreach ($types as $type) {
            ProductType::create($type);
        }
    }
}
