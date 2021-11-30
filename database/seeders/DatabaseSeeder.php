<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insertOrIgnore([
            [
                'name'      => 'Apple (unit ~150g)',
                'price'     => 2,
                'stock'     => 1000,
                'thumbnail' => 'apple.png',
                'created_at' => now()->format('Y-m-d h:i:s'),
                'updated_at' => now()->format('Y-m-d h:i:s')
            ],
            [
                'name'      => 'Avocado (unit ~650g)',
                'price'     => 7.5,
                'stock'     => 700,
                'thumbnail' => 'avocado.png',
                'created_at' => now()->format('Y-m-d h:i:s'),
                'updated_at' => now()->format('Y-m-d h:i:s')
            ],
            [
                'name'      => 'Banana (1kg)',
                'price'     => 8,
                'stock'     => 1000,
                'thumbnail' => 'banana.png',
                'created_at' => now()->format('Y-m-d h:i:s'),
                'updated_at' => now()->format('Y-m-d h:i:s')
            ],
            [
                'name'      => 'Kiwi (unit ~100g)',
                'price'     => 3.5,
                'stock'     => 500,
                'thumbnail' => 'kiwi.png',
                'created_at' => now()->format('Y-m-d h:i:s'),
                'updated_at' => now()->format('Y-m-d h:i:s')
            ],
            [
                'name'      => 'Melon(unit ~750g)',
                'price'     => 6.5,
                'stock'     => 400,
                'thumbnail' => 'melon.png',
                'created_at' => now()->format('Y-m-d h:i:s'),
                'updated_at' => now()->format('Y-m-d h:i:s')
            ],
            [
                'name'      => 'Orange (1kg)',
                'price'     => 6,
                'stock'     => 600,
                'thumbnail' => 'orange.png',
                'created_at' => now()->format('Y-m-d h:i:s'),
                'updated_at' => now()->format('Y-m-d h:i:s')
            ],
            [
                'name'      => 'Peach (unit ~120g)',
                'price'     => 3,
                'stock'     => 500,
                'thumbnail' => 'peach.png',
                'created_at' => now()->format('Y-m-d h:i:s'),
                'updated_at' => now()->format('Y-m-d h:i:s')
            ],
            [
                'name'      => 'Pear (unit ~120g)',
                'price'     => 2.75,
                'stock'     => 500,
                'thumbnail' => 'pear.png',
                'created_at' => now()->format('Y-m-d h:i:s'),
                'updated_at' => now()->format('Y-m-d h:i:s')
            ],
            [
                'name'      => 'Pineapple (unit ~650g)',
                'price'     => 7.5,
                'stock'     => 350,
                'thumbnail' => 'pineapple.png',
                'created_at' => now()->format('Y-m-d h:i:s'),
                'updated_at' => now()->format('Y-m-d h:i:s')
            ],
            [
                'name'      => 'Watermelon (unit ~800g)',
                'price'     => 8.8,
                'stock'     => 450,
                'thumbnail' => 'watermelon.png',
                'created_at' => now()->format('Y-m-d h:i:s'),
                'updated_at' => now()->format('Y-m-d h:i:s')
            ],
        ]);
    }

}
