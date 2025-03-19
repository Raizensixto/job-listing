<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password'  => '123456'
        ]);

        $this->call(JobSeeder::class);


        //  //these are from mine
        // User::factory(98)->create(); // 98 regular verified users
        // User::factory()->unverified()->create(); // 1 unverified user

        // User::factory()->admin()->create([
        //     'first_name' => 'Jonas',
        //     'last_name' => 'Bacuño',
        //     'email' => 'admin@orpawnage.com'
        // ]);  // 1 admin

        // $this->call(JobSeeder::class); // seeder that creates job_listings
    }
}

