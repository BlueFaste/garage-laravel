<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $users = User::all();


        $brands = Brand::all();


//    $users = User::has('vehicles')->get();

        return view('home', [
            'users' => $users,
            'brands' => $brands
        ]);

    }
}
