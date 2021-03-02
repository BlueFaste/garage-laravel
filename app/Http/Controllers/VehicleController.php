<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Vehicle;
use App\Services\CannotReservedVehicleLockedException;
use Illuminate\Cache\Repository;
use Illuminate\Http\Request;
use App\Services\VehicleService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CreateVehicleRequest;
use App\Http\Requests\ReservedVehicleRequest;
use App\Services\UserHasNotEnoughMoneyException;

class VehicleController extends Controller
{
    /**
     * @var \App\Services\VehicleService
     */
    protected $vehicleService;

    public function __construct(VehicleService $vehicleService, Repository $cache)
    {
        $this->vehicleService = $vehicleService;
        $this->cache = $cache;

    }

    public function index(Request $request)
    {

        if ($this->cache->has('vehicles')){
            $vehicles = $this->cache->get('vehicles');
        } else {
            $vehicles = Vehicle::with('brand')->get();
            $this->cache->put('vehicles', $vehicles, 10);
        }


        return view('vehicles.index', ['vehicles' => $vehicles]);
    }

    public function create()
    {
        $brands = Brand::all();

        return view('vehicles.create', ['brands' => $brands]);
    }

    public function store(CreateVehicleRequest $request): RedirectResponse
    {
        $this->vehicleService->saveVehicle(
            $request->get('brand_id'),
            $request->get('name'),
            $request->get('price'),
            $request->get('status'),
            $request->get('odometer'),
            $request->get('type')
          );

        return redirect()->route('vehicles.create');
    }

    public function reserved($id)
    {
        $vehicle = Vehicle::findOrFail($id);

        return view('vehicles.reserved', ['vehicle' => $vehicle]);
    }

    public function storeReserved(ReservedVehicleRequest $request, $id)
    {
        $vehicle = Vehicle::findOrFail($id);

        $user = Auth::user();

        try {
            $this->vehicleService->reserved($vehicle, $user, $request->all());

            return redirect('/');
        } catch (UserHasNotEnoughMoneyException $exception) {
            return back()->withErrors(['error' => "Vous n'avez pas asser d'argent pour louer cette voiture sur cette durée"]);
        } catch(CannotReservedVehicleLockedException $exception) {
            return back()->withErrors(['error' => 'Le véhicule ne peut pas être reservé pendant cette période']);
        }
    }
}
