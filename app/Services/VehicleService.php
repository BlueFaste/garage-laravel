<?php

namespace App\Services;

use App\Models\Vehicle;

class VehicleService
{
    /**
     * Enregistre un véhicule en base de donnée
     */
    public function saveVehicle(array $inputs): Vehicle
    {
        if ($inputs['name'] && $inputs['brand_id'] && $inputs['price'] && $inputs['status'] && $inputs['odometer'] && $inputs['type']) {
            var_dump($inputs);
            $newVehicle = Vehicle::create($inputs);
            return $newVehicle;
        }
    }
}
f
