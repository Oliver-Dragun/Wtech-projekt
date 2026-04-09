<?php

namespace Database\Seeders;

use App\Models\ShippingMethod;
use Illuminate\Database\Seeder;

class ShippingMethodSeeder extends Seeder
{
    public function run(): void
    {
        $methods = [
            ['name' => 'Standard Delivery',  'price' => 5],
            ['name' => 'Express Delivery',   'price' => 10],
            ['name' => 'Courier Delivery',   'price' => 15],
        ];

        foreach ($methods as $method) {
            ShippingMethod::create($method);
        }
    }
}
