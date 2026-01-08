<?php

namespace Database\Seeders;

use App\Models\User;
<<<<<<< HEAD
=======
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
>>>>>>> a1fd054322ab54ed5b743f83ff0083053b55df6f
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
<<<<<<< HEAD
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        // Create demo user
        User::create([
            'name' => 'Demo User',
            'email' => 'demo@example.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        // Create some test users
        User::factory(5)->create();
    }
}
=======
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@forum.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'subscription_status' => 'active',
            'email_verified_at' => now(),
        ]);

        // Create Moderator User
        User::create([
            'name' => 'Moderator User',
            'email' => 'moderator@forum.com',
            'password' => Hash::make('password'),
            'role' => 'moderator',
            'subscription_status' => 'active',
            'email_verified_at' => now(),
        ]);

        // Create Regular Users
        User::create([
            'name' => 'John Doe',
            'email' => 'john@forum.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'subscription_status' => 'active',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Jane Smith',
            'email' => 'jane@forum.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'subscription_status' => 'active',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Bob Johnson',
            'email' => 'bob@forum.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'subscription_status' => 'pending',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Alice Williams',
            'email' => 'alice@forum.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'subscription_status' => 'expired',
            'email_verified_at' => now(),
        ]);
    }
}
>>>>>>> a1fd054322ab54ed5b743f83ff0083053b55df6f
