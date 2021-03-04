<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\AnnoucementController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;
use \App\Http\Middleware\HisAnnoucement;

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
Auth::routes();

Route::get('/', [VehicleController::class, 'index'])->name('vehicles.index');

Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'user'], function () {
        Route::get('/settings', [UserController::class, 'settings'])->name('user.settings');
        Route::put('/settings/money', [UserController::class, 'addMoney'])->name('user.add.money');
        Route::get('/reservations', [UserController::class, 'reservations'])->name('user.show.reservations');
    });
    Route::group(['prefix' => 'vehicles'], function () {
        Route::get('/{id}/reserved', [VehicleController::class, 'reserved'])->name('vehicles.reserved');
        Route::post('/{vehicle}/reserved', [VehicleController::class, 'storeReserved'])->name('vehicules.reserved.store');
    });

    Route::group(['prefix' => 'annoucements'], function (){
        Route::get('/',[AnnoucementController::class, 'index'])->name('annoucement.index');
        Route::get('/create',[AnnoucementController::class, 'displayStore'])->name('annoucement.display.store');
        Route::post('/create',[AnnoucementController::class, 'store'])->name('annoucement.store');
        Route::get('/{annoucement}',[AnnoucementController::class, 'show'])->name('annoucement.show');

//        Route::group(['middleware' => [HisAnnoucement::class]], function () {
            Route::get('/update/{annoucement}', [AnnoucementController::class, 'displayUpdate'])->name('annoucement.display.update');
            Route::put('/update/{annoucement}', [AnnoucementController::class, 'update'])->name('annoucement.update');
            Route::delete('/delete/{annoucement}', [AnnoucementController::class, 'delete'])->name('annoucement.delete');
//        });
    });

//    Route::group(['prefix' => 'comments'], function (){
//       Route::get('/',[AnnoucementController::class, 'index'])->name('annoucement.index');
//       Route::get('/{annoucement}',[AnnoucementController::class, 'show'])->name('annoucement.show');
//       Route::post('/',[AnnoucementController::class, 'store'])->name('annoucement.store');
//       Route::put('/{annoucement}',[AnnoucementController::class, 'update'])->name('annoucement.update');
//       Route::delete('/{annoucement}',[AnnoucementController::class, 'delete'])->name('annoucement.delete');
//    });
});

Route::group(['prefix' => 'admin', 'middleware' => [IsAdmin::class]], function () {
    Route::get('/vehicles/create', [VehicleController::class, 'create'])->name('vehicles.create');
    Route::post('/vehicles', [VehicleController::class, 'store'])->name('vehicles.store');
    Route::get('/vehicles',[Admin\VehicleController::class, 'index'])->name('admin.vehicle.index');
    Route::get('/vehicles/{id}',[Admin\VehicleController::class, 'show'])->name('admin.vehicle.show');
    Route::put('/vehicles/{id}',[Admin\VehicleController::class, 'update'])->name('admin.vehicle.update');
});
