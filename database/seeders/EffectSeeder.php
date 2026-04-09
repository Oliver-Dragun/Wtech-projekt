<?php

namespace Database\Seeders;

use App\Models\Effect;
use Illuminate\Database\Seeder;

class EffectSeeder extends Seeder
{
    public function run(): void
    {
        $effects = [
            'Healing',
            'Speed Boost',
            'Mana Restoration',
            'Fire Resistance',
            'Invisibility',
            'Strength',
            'Fortitude',
            'Restoration',
        ];

        foreach ($effects as $name) {
            Effect::create(['name' => $name]);
        }
    }
}
