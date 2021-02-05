<?php

namespace App\Http\Controllers;

use App\Http\Requests\locationResquest;
use App\Models\Brand;
use App\Models\User;
use App\Models\UserVehicle;
use App\Models\Vehicle;
use Faker\Provider\DateTime;
use Illuminate\Http\Request;
use App\Services\VehicleService;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CreateVehicleRequest;
use Illuminate\Support\Facades\Auth;

class VehicleController extends Controller
{
    /**
     * @var \App\Services\VehicleService
     */
    protected $vehicleService;

    public function __construct(VehicleService $vehicleService)
    {
        $this->vehicleService = $vehicleService;
    }

    public function index(Request $request)
    {
        $vehicles = Vehicle::with('brand')->get();

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

    public function details($id)
    {
        $veh = Vehicle::find($id);
        $user = User::find(Auth::id());
        $userVeh = UserVehicle::where('vehicle_id', $veh->id)->get();

        return view('vehicles/detail', ['vehicle' => $veh, 'user' => $user,'userVehicle'=>$userVeh, 'price' =>null, 'nbDay'=>null, 'dateStart'=>null, 'available'=>null]);
    }

    public function calculePrice(locationResquest $request)
    {
        $veh = Vehicle::find($request->get('idVehicle'));
        $user = User::find(Auth::id());
       $userVehicle = UserVehicle::where('vehicle_id',$veh->id)->get();

       $nbday= $request->get('nbDay');
       $price = $veh->price * $nbday;

        $available = true;
        foreach ($userVehicle as $uv){
            $ended_At = strtotime($uv->ended_at);
            $started_at = strtotime($uv->started_at);
            $date_location =(strtotime($request->get('dateStart')))+(3600*24*($nbday-1));

            if($started_at<= strtotime($request->get('dateStart')) && strtotime($request->get('dateStart'))<=$ended_At){
                $available=false;
            } elseif ($started_at<= $date_location && $date_location<= $ended_At) {
                $available=false;
            } elseif (strtotime($request->get('dateStart')) <= $started_at && $started_at <= $date_location){
                $available=false;
            } elseif (strtotime($request->get('dateStart')) <= $started_at && $ended_At<=$date_location){
                $available=false;
            }

        }

//        dd($userVehicle[0]->user_id);
       return view('vehicles/detail',['vehicle'=>$veh,'user' => $user,'userVehicle'=>$userVehicle,  'price'=>$price, 'nbDay'=>$nbday, 'dateStart'=>$request->get('dateStart'), 'available'=>$available]);
    }

    public function paye(locationResquest $request)
    {
        $veh = Vehicle::find($request->get('idVehicle'));
        $user = User::find(Auth::id());

        $nbday= $request->get('nbDay');
        $price = $veh->price * $nbday;

//        $user->wallet =0;
        $user->wallet = $user->wallet - $price;
        $user->save();

        $veh->status = "locked";
        $veh->save();


        $startDate=$request->get('dateStart');
        $startTimestamp= strtotime($startDate);
        $endTimestamp = $startTimestamp + (3600*24*($nbday-1));
        $endDate = date('Y-m-d', $endTimestamp);

        $userVehicle =new UserVehicle([
           'user_id'=>$user->id,
           'vehicle_id'=>$veh->id,
           'started_at'=>$startDate,
            'ended_at'=> $endDate
        ]);
        $userVehicle->save();

        return redirect()->route('user.settings', ['user' => $user]);


    }

}
