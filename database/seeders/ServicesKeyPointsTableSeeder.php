<?php

namespace Database\Seeders;

use App\Models\ServiceKeyPoint;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServicesKeyPointsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ServiceKeyPoint::factory()->count(20)->create();
    }
}
