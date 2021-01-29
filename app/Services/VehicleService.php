<?php

namespace App\Services;

use App\Models\Brand;
use App\Models\Vehicle;
use Mockery\Exception;
use phpDocumentor\Reflection\Types\Object_;
use PhpParser\Node\Expr\Array_;

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

    public function getAllVehicles(): Object
    {
        return Vehicle::all();
    }

    public function getAllAvailableVehicle(): Object
    {
        return Vehicle::where('status','available')->get();
    }
}
