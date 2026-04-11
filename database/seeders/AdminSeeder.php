<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'     => 'admin',
            'surname'  => 'admin',
            'email'    => 'admin@admin.com',
            'password' => 'admin',
            'is_admin' => true,
        ]);
    }
}
