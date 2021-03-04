<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserVehicle;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Http\Requests\AddMoneyWalletRequest;
use phpDocumentor\Reflection\Types\Collection;

class UserController extends Controller
{
    public function settings(Request $request)
    {
        $user = $request->user();

        return view('users.settings', ['user' => $user]);
    }

    public function addMoney(AddMoneyWalletRequest $request)
    {
        $user = $request->user();

        $user->update([
           'wallet' => $user->wallet + $request->get('amount'),
        ]);

        return redirect()->back();
    }

    public function getRent(Request $request)
    {
        $user = $request->user();
        return $this->goToRent($user);

    }


    public function addDayOfRent(Request $request, $id){


        $userVehicle = UserVehicle::find($id);
        $user = User::find($userVehicle->user_id);
        $vehicle = Vehicle::find($userVehicle->vehicle_id);

        if(!$user){
            dd('Erreur user');
        }
        if(!$vehicle){
            dd('Erreur Vehicle');
        }
        if($userVehicle){
            $priceVehicle= $vehicle->price;


            if($request->get('numberDay') != 0){
                $dataEnd= strtotime($userVehicle->ended_at);
                $userVehicle->ended_at = $dataEnd + (3600*24*$request->get('numberDay'));

            } else{
                $userVehicle->ended_at = $request->get('newDate');
            }
            $userVehicle->save();
            $user = $request->user();
           return $this->goToRent($user);
        }else{
            dd('erreur');
        }

    }

    public function displayFormAddDayOfRent($id)
    {
        $vehicle= UserVehicle::findOrFail($id);

        return view('users.rentalAdd', ['id'=>$id, 'vehicle' => $vehicle] );
    }

    protected function goToRent($user)
    {
        $vehicles = $user->vehicles;
        return view('users.rental', ['rent' => $vehicles]);
    }
}
