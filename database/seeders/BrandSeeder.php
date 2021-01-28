<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Brand::factory()
            ->count(3)
            ->has(Vehicle::factory()->count(10))
            ->create();
    }
}
