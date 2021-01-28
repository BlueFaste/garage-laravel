<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(3)->admin()->create();

        $customers = User::factory()
            ->count(3)
            ->hasAttached(Vehicle::all()->random(),['started_at' => now(), 'ended_at' => now()->addDays(10)])
//                ->count(1)
//                ->for(Brand::all()->random()))
            ->create();
    }
}
