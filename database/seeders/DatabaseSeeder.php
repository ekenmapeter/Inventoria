<?php

namespace Database\Seeders;

<<<<<<< HEAD
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
=======
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
>>>>>>> a1fd054322ab54ed5b743f83ff0083053b55df6f
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
<<<<<<< HEAD
=======
    use WithoutModelEvents;

>>>>>>> a1fd054322ab54ed5b743f83ff0083053b55df6f
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
<<<<<<< HEAD
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call([
            UserSeeder::class,
            LocationSeeder::class,
            CategorySeeder::class,
            SupplierSeeder::class,
=======
        $this->call([
            UserSeeder::class,
            ForumSeeder::class,
            PaymentSeeder::class,
>>>>>>> a1fd054322ab54ed5b743f83ff0083053b55df6f
        ]);
    }
}
