<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    public function run(): void
    {
        $sizes = ['Small', 'Medium', 'Large', 'Greater'];

        foreach ($sizes as $size) {
            Size::create(['size' => $size]);
        }
    }
}
