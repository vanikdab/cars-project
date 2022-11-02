<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('login', [\App\Http\Controllers\AuthController::class,  'login']);
    Route::get('drivers', [\App\Http\Controllers\DriverController::class, 'allDrivers']);
    Route::get('driversWithCar', [\App\Http\Controllers\DriverController::class, 'withCar']);
    Route::post('driver/setCar', [\App\Http\Controllers\DriverController::class, 'setCar']);
    Route::get('driver/getCar', [\App\Http\Controllers\DriverController::class, 'getCar']);
    Route::get('cars', [\App\Http\Controllers\DriverController::class, 'allCars']);
    Route::post('addCar', [\App\Http\Controllers\DriverController::class, 'addCar']);
});
