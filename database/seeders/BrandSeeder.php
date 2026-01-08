<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            [
                'name' => 'Apple',
                'description' => 'Premium technology products and devices',
            ],
            [
                'name' => 'Samsung',
                'description' => 'Leading manufacturer of electronics and smartphones',
            ],
            [
                'name' => 'Dell',
                'description' => 'Computer technology and services company',
            ],
            [
                'name' => 'HP',
                'description' => 'Personal computers, printers, and imaging products',
            ],
            [
                'name' => 'Lenovo',
                'description' => 'Personal computers and smart devices',
            ],
            [
                'name' => 'ASUS',
                'description' => 'Computer hardware and electronics company',
            ],
            [
                'name' => 'Acer',
                'description' => 'Computer hardware and electronics company',
            ],
            [
                'name' => 'Sony',
                'description' => 'Electronics, gaming, and entertainment products',
            ],
            [
                'name' => 'Microsoft',
                'description' => 'Software and technology solutions',
            ],
            [
                'name' => 'LG',
                'description' => 'Electronics and home appliances',
            ],
        ];

        foreach ($brands as $brand) {
            Brand::create($brand);
        }
    }
}
