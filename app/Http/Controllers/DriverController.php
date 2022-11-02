<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddCarRequest;
use App\Http\Requests\AssociateCarRequest;
use App\Http\Services\DriverService;
use App\Models\Driver;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    protected $service;

    public function __construct()
    {
        $this->service = new DriverService;
    }

    /**
     * Get the all Drivers.
     *
     * @return JsonResponse
     */
    public function allDrivers(): JsonResponse
    {
        return response()->json($this->service->all());
    }

    /**
     * Get the all Drivers.
     *
     * @return JsonResponse
     */
    public function withCar(): JsonResponse
    {
        return response()->json($this->service->withCars());
    }

    /**
     * Initialize car.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCar(Request $request): JsonResponse
    {
        $driverId = $request->get('driver_id');
        $driverWithCar = $this->service->getCar($driverId);

        if (!$driverWithCar) {
            return response()->json(['Driver does not exist!']);
        }

        return response()->json($driverWithCar->car);
    }

    /**
     * Initialize car.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function setCar(AssociateCarRequest $request): JsonResponse
    {
        $driver = $this->service->setCar($request);

        if (!$driver) {
            return response()->json(['Driver does not exist!']);
        }

        return response()->json($driver);
    }

    /**
     * Initialize car.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function addCar(AddCarRequest $request): JsonResponse
    {
        return response()->json($this->service->addCar($request));
    }
}
