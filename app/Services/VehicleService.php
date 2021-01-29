<?php

namespace App\Services;

use App\Models\Brand;
use App\Models\Vehicle;
use Mockery\Exception;

class VehicleService
{
    /**
     * Enregistre un véhicule en base de donnée
     */
    public function saveVehicle(array $inputs): Vehicle
    {
        if ($inputs['name'] && $inputs['brand_id'] && $inputs['price'] && $inputs['status'] && $inputs['odometer'] && $inputs['type']) {
            try {
                $brand = Brand::find($inputs['brand_id']);
                if (!$brand) {
                    throw new Exception('Exception: Pas de brand in bdd');
                }

            } catch (Exception $err) {
                throw $err;
            }
            $newVehicle = Vehicle::create($inputs);
            return $newVehicle;
        }
    }
}
