<?php

namespace Database\Seeders;

use App\Models\User;
// use BlogsTableSeeder;
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
        ]);

        $this->call([
            BlogsTableSeeder::class,
            ServicesTableSeeder::class,
            ServicesKeyPointsTableSeeder::class,
            ServicesDetailsTableSeeder::class,
        ]);
    }
}
