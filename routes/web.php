<?php

use App\Models\Brand;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group(['prefix' => 'vehicles'], function () {
    Route::get('/create', [\App\Http\Controllers\VehicleController::class, 'create']);
    Route::post('/', [\App\Http\Controllers\VehicleController::class, 'store'])->name('vehicle.store');
    Route::get ('/listing',[\App\Http\Controllers\VehicleController::class, 'listing'])->name('vehicle.listing');
});

require __DIR__ . '/auth.php';
