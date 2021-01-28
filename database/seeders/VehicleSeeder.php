<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vehicle::factory()
            ->count(10)
            ->for(Brand::all()->random())
            ->create();
    }
}
