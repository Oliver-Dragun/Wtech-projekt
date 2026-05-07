<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductPhoto;
use Illuminate\Database\Seeder;

class ProductPhotoSeeder extends Seeder
{
    public function run(): void
    {
        $storeImages = [
            'Healing Potion' => 'images/potion-images/healing-potion.png',
            'Speed Potion' => 'images/potion-images/speed-potion.png',
            'Fire Resistance Potion' => 'images/potion-images/fireresistance-potion.png',
            'Restoration Potion' => 'images/potion-images/restoration-potion.png',
            'Mana Potion' => 'images/potion-images/mana-potion.png',
            'Invisibility Potion' => 'images/potion-images/invisibility-potion.png',
            'Strength Potion' => 'images/potion-images/strength-potion.png',
            'Fortitude Potion' => 'images/potion-images/fortitude-potion.png',
            'Scroll of Fireball' => 'images/scroll-images/scroll-fireball.png',
            'Scroll of Healing' => 'images/scroll-images/scroll-healing.png',
            'Scroll of Lightning' => 'images/scroll-images/scroll-lightning.png',
            'Scroll of Protection' => 'images/scroll-images/scroll-protection.png',
            'Scroll of Frost' => 'images/scroll-images/scroll-frost.png',
            'Scroll of Necromancy' => 'images/scroll-images/scroll-necromancy.png',
            'Scroll of Haste' => 'images/scroll-images/scroll-haste.png',
            'Scroll of Strength' => 'images/scroll-images/scroll-strength.png',
            'Orb of Healing' => 'images/orb-images/orb-healing.png',
            'Orb of Fire' => 'images/orb-images/orb-fire.png',
            'Orb of Frost' => 'images/orb-images/orb-frost.png',
            'Orb of Shadow' => 'images/orb-images/orb-shadow.png',
            'Orb of Lightning' => 'images/orb-images/orb-lightning.png',
            'Orb of Protection' => 'images/orb-images/orb-protection.png',
            'Orb of Restoration' => 'images/orb-images/orb-restoration.png',
            'Orb of the Void' => 'images/orb-images/orb-void.png',
            'Flame Blade' => 'images/artifact-images/flame-blade.png',
            'Guardian Shield' => 'images/artifact-images/guardian-shield.png',
            'Thunderstrike Spear' => 'images/artifact-images/thunderstrike-spear.png',
            'Necromancer\'s Staff' => 'images/artifact-images/necromancers-staff.png',
            'Frostfang Dagger' => 'images/artifact-images/frostfang-dagger.png',
            'Healer\'s Mace' => 'images/artifact-images/healers-mace.png',
            'Stormcaller Bow' => 'images/artifact-images/stormcaller-bow.png',
            'Ironbark Greataxe' => 'images/artifact-images/ironbark-greataxe.png',
        ];

        foreach ($storeImages as $productName => $img) {
            $products = Product::where('name', $productName)
                ->where('category_id', '!=', 5)
                ->orderBy('id')
                ->get();

            foreach ($products as $product) {
                ProductPhoto::create([
                    'product_id' => $product->id,
                    'number' => 0,
                    'img' => $img,
                ]);

                if ($productName === 'Healing Potion') {
                    ProductPhoto::create(['product_id' => $product->id, 'number' => 1, 'img' => 'images/product-images/healing-potion/healing-potion-product-1.png']);
                    ProductPhoto::create(['product_id' => $product->id, 'number' => 2, 'img' => 'images/product-images/healing-potion/healing-potion-product-2.png']);
                    ProductPhoto::create(['product_id' => $product->id, 'number' => 3, 'img' => 'images/product-images/healing-potion/healing-potion-product-3.png']);
                }
            }
        }

        $bundles = [
            'Healer\'s Arsenal' => [
                'store' => 'images/bundle-images/healers-arsenal.png',
                'items' => [
                    'images/potion-images/healing-potion.png',
                    'images/scroll-images/scroll-healing.png',
                    'images/orb-images/orb-healing.png',
                    'images/artifact-images/healers-mace.png',
                ],
            ],
            'Pyromancer\'s Kit' => [
                'store' => 'images/bundle-images/pyromancers-kit.png',
                'items' => [
                    'images/potion-images/fireresistance-potion.png',
                    'images/scroll-images/scroll-fireball.png',
                    'images/orb-images/orb-fire.png',
                    'images/artifact-images/flame-blade.png',
                ],
            ],
            'Stormcaller\'s Bundle' => [
                'store' => 'images/bundle-images/stormcallers-bundle.png',
                'items' => [
                    'images/potion-images/speed-potion.png',
                    'images/scroll-images/scroll-lightning.png',
                    'images/orb-images/orb-lightning.png',
                    'images/artifact-images/thunderstrike-spear.png',
                ],
            ],
            'Shadow Collector\'s Set' => [
                'store' => 'images/bundle-images/shadow-collectors-set.png',
                'items' => [
                    'images/potion-images/invisibility-potion.png',
                    'images/scroll-images/scroll-necromancy.png',
                    'images/orb-images/orb-shadow.png',
                    'images/artifact-images/necromancers-staff.png',
                ],
            ],
        ];

        foreach ($bundles as $productName => $data) {
            $product = Product::where('name', $productName)->where('category_id', 5)->first();

            if (!$product) {
                continue;
            }

            ProductPhoto::create(['product_id' => $product->id, 'number' => 0, 'img' => $data['store']]);

            foreach ($data['items'] as $i => $img) {
                ProductPhoto::create(['product_id' => $product->id, 'number' => $i + 1, 'img' => $img]);
            }
        }
    }
}
