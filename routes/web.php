<?php

use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use \App\Http\Controllers\Admin;
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
    });
    Route::group(['prefix' => 'vehicles'], function () {
        Route::get('/{id}/reserved', [VehicleController::class, 'reserved'])->name('vehicles.reserved');
        Route::post('/{vehicle}/reserved', [VehicleController::class, 'storeReserved'])->name('vehicules.reserved.store');
    });
});

Route::group(['prefix' => 'admin', 'middleware' => [IsAdmin::class]], function () {
    Route::get('/vehicles/create', [VehicleController::class, 'create'])->name('vehicles.create');
    Route::post('/vehicles', [VehicleController::class, 'store'])->name('vehicles.store');
    Route::get('/vehicles',[Admin\VehicleController::class, 'index'])->name('admin.vehicle.index');
    Route::get('/vehicles/{id}',[Admin\VehicleController::class, 'show'])->name('admin.vehicle.show');
    Route::put('/vehicles/{id}',[Admin\VehicleController::class, 'update'])->name('admin.vehicle.update');
});

Route::get('/demo/test/{paramOpt?}', [TestController::class, 'test'])->name('test.test');

Route::group(['prefix' => 'brand'], function(){
    Route::get('/', [BrandController::class, 'index'])->name('brand.index');
   Route::get('/{id}', [BrandController::class, 'show'])->name('brand.show');
   Route::delete('/delete/{id}', [BrandController::class, 'delete'])->name('brand.delete');
   Route::post('/create', [BrandController::class, 'create'])->name('brand.create');
   Route::put('/update/{id}', [BrandController::class, 'update'])->name('brand.update');
});

Route::group(['prefix' => 'form', 'middleware'=>[\App\Http\Middleware\Is12YearsOld::class]], function(){
   Route::get('/',[\App\Http\Controllers\FormController::class, 'show'])->name('form.show');
   Route::post('/verification',[\App\Http\Controllers\FormController::class, 'verification'])->name('form.verification');
});
