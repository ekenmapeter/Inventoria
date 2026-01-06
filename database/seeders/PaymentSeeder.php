<?php

namespace Database\Seeders;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::where('email', 'admin@forum.com')->first();
        $bob = User::where('email', 'bob@forum.com')->first();
        $alice = User::where('email', 'alice@forum.com')->first();

        // Create pending payments
        Payment::create([
            'amount' => 29.99,
            'status' => 'pending',
            'user_id' => $bob->id,
        ]);

        Payment::create([
            'amount' => 29.99,
            'status' => 'pending',
            'user_id' => $alice->id,
        ]);

        // Create approved payment
        Payment::create([
            'amount' => 29.99,
            'status' => 'approved',
            'user_id' => $bob->id,
            'admin_id' => $admin->id,
        ]);

        // Create rejected payment
        Payment::create([
            'amount' => 29.99,
            'status' => 'rejected',
            'user_id' => $alice->id,
            'admin_id' => $admin->id,
        ]);
    }
}
