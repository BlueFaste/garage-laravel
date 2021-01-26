<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;

//use App\Models\Vehicle;
use App\Models\Brand;
use App\Models\UserVehicle;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $users = User::all();
    echo "<h1> Les utilisateurs</h1>";
    echo "<ul>";
    foreach ($users as $user) {
        echo "<li> #$user->id $user->name (score: $user->score, porte-monnaie: $user->vallet, role: $user->role, actif: $user->enabled)</li>";
    }
    echo '</ul>';


    $brands = Brand::all();
    echo "<h1> Les marques et leurs vehicules </h1>";
    echo "<ul>";
    foreach ($brands as $brand) {
        echo "<li> #$brand->id $brand->name (premium: $brand->premium), Véhicules: <ul>   ";
        $vehicles = $brand->vehicles;
        foreach ($vehicles as $vehicle) {
            echo "<li> #$vehicle->id $vehicle->name (price: $vehicle->price, status: $vehicle->status, odometer: $vehicle->odometer, type: $vehicle->type, brand: $vehicle->brand_id)</li>";

        }
        echo '</li></ul>';
    }
    echo '</ul>';

    $locations = UserVehicle::all();
    echo "<h1> Les locations et leur client</h1>";
    echo "<ul>";
    foreach ($locations as $location) {
        $vehi = $location->vehicle;
        $us = $location->user;
        echo "<li> #$location->id client: #$us->id $us->name vehicule: #$vehi->id $vehi->name: début le $location->started_at , fini le $location->ended_at</li>";
    }
    echo '</ul>';


    $users = User::all();
    echo "<h1> Les utilisateurs et leurs locations</h1>";
    echo "<ul>";
    foreach ($users as $user) {
        echo "<li> #$user->id $user->name , locations: <ul> ";
        foreach ($user->user_vehicle as $uv) {
            $vehi = $uv->vehicle;
            echo "<li> #$uv->id $vehi->name, début le $uv->started_at , fini le $uv->ended_at</li>";
        }
        echo "</ul>";
    }
    echo '</li></ul>';

    return view('welcome');
});
