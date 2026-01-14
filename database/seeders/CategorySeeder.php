<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Electronics',
                'description' => 'Electronic devices and accessories'
            ],
            [
                'name' => 'Furniture',
                'description' => 'Home and office furniture'
            ],
            [
                'name' => 'Clothing',
                'description' => 'Apparel and accessories'
            ],
            [
                'name' => 'Books',
                'description' => 'Books and publications'
            ],
            [
                'name' => 'Food & Beverages',
                'description' => 'Food items and drinks'
            ],
            [
                'name' => 'Office Supplies',
                'description' => 'Office stationery and supplies'
            ],
            [
                'name' => 'Tools & Hardware',
                'description' => 'Tools and hardware items'
            ],
            [
                'name' => 'Health & Beauty',
                'description' => 'Health and beauty products'
            ]
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'name' => $category['name'],
                'description' => $category['description'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
