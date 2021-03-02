<?php

namespace App\Http\Controllers;

use App\Models\UserVehicle;
use Illuminate\Http\Request;
use App\Http\Requests\AddMoneyWalletRequest;
use phpDocumentor\Reflection\Types\Collection;

class UserController extends Controller
{
    public function settings(Request $request)
    {
        $user = $request->user();
//        dd($user);

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
        $vehicles = $user->vehicles;
        return view('users.rental', ['rent' => $vehicles]);

    }


    public function addDayOfRent(){

    }

    public function displayFormAddDayOfRent($id){
        return view('users.rentalAdd', ['id'=>$id]);
    }

}
