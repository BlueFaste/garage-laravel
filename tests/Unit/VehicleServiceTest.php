<?php

namespace Tests\Unit;

use App\Models\Brand;
use \App\Services\VehicleService;
use Mockery\Exception;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VehicleServiceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_save_vehicle()
    {

        // Création d'une marque
        $brand = Brand::factory()->create();

        // Préparer des données
        $brand_id = $brand->id;
        $name = 'Canard';
        $price = '20000';
        $status = 'Disponible';
        $odometer = '2500';
        $type = 'Sport';

        // Instancier un VehicleService
        $vehicleService = new VehicleService();
        // Les paramètres du véhicule
        // Utiliser la méthode saveVehicle
        $inputs = ['brand_id' => $brand_id, 'name' => $name, 'price' => $price, 'status' => $status, 'odometer' => $odometer, 'type' => $type];
        $vehicle = $vehicleService->saveVehicle($inputs);
        // Vérifier la présence du record en bdd
        $this->assertDatabaseHas('vehicles', [
            'name' => $name,
            'price' => $price,
            'status' => $status,
            'odometer' => $odometer,
            'type' => $type,
        ]);
    }

    /** @test */
    public function cant_save_vehicle_without_existing_brand()
    {
        // Création d'une marque
//        $brand= Brand::factory()->create();

        // Préparer des données
        $brand_id = 2;
        $name = 'Canard';
        $price = '20000';
        $status = 'Disponible';
        $odometer = '2500';
        $type = 'Sport';

        // Instancier un VehicleService
        $vehicleService = new VehicleService();
        // Les paramètres du véhicule
        // Utiliser la méthode saveVehicle
        $inputs = ['brand_id' => $brand_id, 'name' => $name, 'price' => $price, 'status' => $status, 'odometer' => $odometer, 'type' => $type];

        try {
            $vehicle = $vehicleService->saveVehicle($inputs);
            if (!$vehicle) {
                throw new Exception('Erreur récupérer');
            }
        } catch (Exception $err) {
            // Vérifier l'absence du record en bdd
            $this->assertDatabaseMissing('vehicles', [
                'name' => $name,
                'price' => $price,
                'status' => $status,
                'odometer' => $odometer,
                'type' => $type,
            ]);
        }

    }


    /** @test */
    public function cant_save_vehicle_without_good_params()
    {
        // Création d'une marque
        $brand= Brand::factory()->create();

        // Préparer des données
        $brand_id = $brand->id;
        $name = 'Canard';
        $price = '20000';
        $status = 'Disponible';
        $odometer = '2500';
        $type = 'Sport';

        // Instancier un VehicleService
        $vehicleService = new VehicleService();
        // Les paramètres du véhicule
        // Utiliser la méthode saveVehicle
        $inputs = ['brand_id' => $brand_id, 'name' => $name, 'price' => $price, 'status' => $status, 'odometer' => $odometer, 'type' => $type];

        try {
            $vehicle = $vehicleService->saveVehicle($inputs);
            if (!$vehicle) {
                throw new Exception('Erreur récupérer');
            }
        } catch (Exception $err) {
            // Vérifier l'absence du record en bdd
            $this->assertDatabaseMissing('vehicles', [
                'name' => $name,
                'price' => $price,
                'status' => $status,
                'odometer' => $odometer,
                'type' => $type,
            ]);
        }
    }
}
