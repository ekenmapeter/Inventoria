<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $units = [
            [
                'name' => 'Piece',
                'symbol' => 'pcs',
            ],
            [
                'name' => 'Kilogram',
                'symbol' => 'kg',
            ],
            [
                'name' => 'Gram',
                'symbol' => 'g',
            ],
            [
                'name' => 'Liter',
                'symbol' => 'L',
            ],
            [
                'name' => 'Milliliter',
                'symbol' => 'ml',
            ],
            [
                'name' => 'Meter',
                'symbol' => 'm',
            ],
            [
                'name' => 'Centimeter',
                'symbol' => 'cm',
            ],
            [
                'name' => 'Box',
                'symbol' => 'box',
            ],
            [
                'name' => 'Pack',
                'symbol' => 'pack',
            ],
            [
                'name' => 'Dozen',
                'symbol' => 'dz',
            ],
        ];

        foreach ($units as $unit) {
            Unit::create($unit);
        }
    }
}
