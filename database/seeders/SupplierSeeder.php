<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $suppliers = [
            [
                'name' => 'Global Electronics Ltd',
                'contact_person' => 'John Smith',
                'email' => 'john@globalelectronics.com',
                'phone' => '+234 801 234 5678',
                'address' => 'Lagos, Nigeria'
            ],
            [
                'name' => 'Office Solutions Nigeria',
                'contact_person' => 'Sarah Johnson',
                'email' => 'sarah@officesolutions.ng',
                'phone' => '+234 802 345 6789',
                'address' => 'Abuja, Nigeria'
            ],
            [
                'name' => 'Tech Distributors',
                'contact_person' => 'Michael Brown',
                'email' => 'michael@techdist.com',
                'phone' => '+234 803 456 7890',
                'address' => 'Port Harcourt, Nigeria'
            ],
            [
                'name' => 'Furniture Plus',
                'contact_person' => 'David Wilson',
                'email' => 'david@furnitureplus.com',
                'phone' => '+234 804 567 8901',
                'address' => 'Kano, Nigeria'
            ]
        ];

        foreach ($suppliers as $supplier) {
            DB::table('suppliers')->insert([
                'name' => $supplier['name'],
                'contact_person' => $supplier['contact_person'],
                'email' => $supplier['email'],
                'phone' => $supplier['phone'],
                'address' => $supplier['address'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
