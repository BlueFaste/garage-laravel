<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function index($id){
        $user = User::find($id);

        return view('users/userIndex',['user'=>$user]);

    }

    public function addMonney(Request $req)
    {
        $user = User::find(Auth::id());
        $user->wallet = $user->wallet + $req->monney;
        $user->save();
        return redirect()->route('user.index', ['id' => Auth::id()]);
//        dd($wallet);
//        User::find(Auth::id())->update()
//        dd(Auth::user());
//        dd($req->all());
    }
}
