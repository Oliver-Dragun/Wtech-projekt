<?php

namespace Database\Seeders;

use App\Models\ProductPhoto;
use Illuminate\Database\Seeder;

class ProductPhotoSeeder extends Seeder
{
    public function run(): void
    {
        // Store images per base product (each base has 4 grade variants)
        // Product IDs: base 1 = IDs 1-4, base 2 = IDs 5-8, etc.
        $storeImages = [
            // Potions (bases 1-8)
            'images/potion-images/healing-potion.png',
            'images/potion-images/speed-potion.png',
            'images/potion-images/fireresistance-potion.png',
            'images/potion-images/restoration-potion.png',
            'images/potion-images/mana-potion.png',
            'images/potion-images/invisibility-potion.png',
            'images/potion-images/strength-potion.png',
            'images/potion-images/fortitude-potion.png',

            // Scrolls (bases 9-16)
            'images/scroll-images/scroll-fireball.png',
            'images/scroll-images/scroll-healing.png',
            'images/scroll-images/scroll-lightning.png',
            'images/scroll-images/scroll-protection.png',
            'images/scroll-images/scroll-frost.png',
            'images/scroll-images/scroll-necromancy.png',
            'images/scroll-images/scroll-haste.png',
            'images/scroll-images/scroll-strength.png',

            // Orbs (bases 17-24)
            'images/orb-images/orb-healing.png',
            'images/orb-images/orb-fire.png',
            'images/orb-images/orb-frost.png',
            'images/orb-images/orb-shadow.png',
            'images/orb-images/orb-lightning.png',
            'images/orb-images/orb-protection.png',
            'images/orb-images/orb-restoration.png',
            'images/orb-images/orb-void.png',

            // Artifacts (bases 25-32)
            'images/artifact-images/flame-blade.png',
            'images/artifact-images/guardian-shield.png',
            'images/artifact-images/thunderstrike-spear.png',
            'images/artifact-images/necromancers-staff.png',
            'images/artifact-images/frostfang-dagger.png',
            'images/artifact-images/healers-mace.png',
            'images/artifact-images/stormcaller-bow.png',
            'images/artifact-images/ironbark-greataxe.png',
        ];

        $productId = 1;

        foreach ($storeImages as $baseIndex => $img) {
            // Each base product has 4 grade variants sharing the same image
            for ($i = 0; $i < 4; $i++) {
                ProductPhoto::create([
                    'product_id' => $productId,
                    'number'     => 0,
                    'img'        => $img,
                ]);

                // Healing Potion variants (base 0, product IDs 1-4) get detail images
                if ($baseIndex === 0) {
                    ProductPhoto::create(['product_id' => $productId, 'number' => 1, 'img' => 'images/product-images/healing-potion/healing-potion-product-1.png']);
                    ProductPhoto::create(['product_id' => $productId, 'number' => 2, 'img' => 'images/product-images/healing-potion/healing-potion-product-2.png']);
                    ProductPhoto::create(['product_id' => $productId, 'number' => 3, 'img' => 'images/product-images/healing-potion/healing-potion-product-3.png']);
                }

                $productId++;
            }
        }

        // ── Bundles (product IDs 129-132) ─────────────────────────────
        // Each bundle: 1 potion + 1 scroll + 1 orb + 1 artifact
        $bundles = [
            // Healer's Arsenal: Healing Potion + Scroll of Healing + Orb of Healing + Healer's Mace
            129 => [
                'store' => 'images/bundle-images/healers-arsenal.png',
                'items' => [
                    'images/potion-images/healing-potion.png',
                    'images/scroll-images/scroll-healing.png',
                    'images/orb-images/orb-healing.png',
                    'images/artifact-images/healers-mace.png',
                ],
            ],
            // Pyromancer's Kit: Fire Resistance Potion + Scroll of Fireball + Orb of Fire + Flame Blade
            130 => [
                'store' => 'images/bundle-images/pyromancers-kit.png',
                'items' => [
                    'images/potion-images/fireresistance-potion.png',
                    'images/scroll-images/scroll-fireball.png',
                    'images/orb-images/orb-fire.png',
                    'images/artifact-images/flame-blade.png',
                ],
            ],
            // Stormcaller's Bundle: Speed Potion + Scroll of Lightning + Orb of Lightning + Thunderstrike Spear
            131 => [
                'store' => 'images/bundle-images/stormcallers-bundle.png',
                'items' => [
                    'images/potion-images/speed-potion.png',
                    'images/scroll-images/scroll-lightning.png',
                    'images/orb-images/orb-lightning.png',
                    'images/artifact-images/thunderstrike-spear.png',
                ],
            ],
            // Shadow Collector's Set: Invisibility Potion + Scroll of Necromancy + Orb of Shadow + Necromancer's Staff
            132 => [
                'store' => 'images/bundle-images/shadow-collectors-set.png',
                'items' => [
                    'images/potion-images/invisibility-potion.png',
                    'images/scroll-images/scroll-necromancy.png',
                    'images/orb-images/orb-shadow.png',
                    'images/artifact-images/necromancers-staff.png',
                ],
            ],
        ];

        foreach ($bundles as $pid => $data) {
            ProductPhoto::create(['product_id' => $pid, 'number' => 0, 'img' => $data['store']]);
            foreach ($data['items'] as $i => $img) {
                ProductPhoto::create(['product_id' => $pid, 'number' => $i + 1, 'img' => $img]);
            }
        }
    }
}
