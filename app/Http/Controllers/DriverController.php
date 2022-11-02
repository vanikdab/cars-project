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
     * @OA\Get(
     *      path="/api/auth/drivers",
     *      operationId="getAllDrvrs",
     *      tags={"Drivers List"},
     *      summary="Get list of drivers",
     *      description="Returns list of drivers",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#Collection|Model[]")
     *       )
     *     )
     */
    public function allDrivers(): JsonResponse
    {
        return response()->json($this->service->all());
    }

    /**
     * @OA\Get(
     *      path="/api/auth/driversWithCar",
     *      operationId="getAllDrvrsWithCars",
     *      tags={"Drivers List"},
     *      summary="Get list of drivers with cars",
     *      description="Returns list of drivers with cars",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#Collection|Model[]")
     *       )
     *     )
     */
    public function withCar(): JsonResponse
    {
        return response()->json($this->service->withCars());
    }

    /**
     * @OA\Post(
     *      path="/api/auth/driver/setCar",
     *      operationId="setDriverCar",
     *      tags={"Get/Set Car"},
     *      summary="Set driver car",
     *      description="Returns driver",
     *      @OA\Parameter(
     *          name="request",
     *          description="Sended request",
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="AssociateCarRequest")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(ref="Driver")
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Driver does not exist!",
     *      )
     * )
     */
    public function setCar(AssociateCarRequest $request): JsonResponse
    {
        $driver = $this->service->setCar($request);

        if (!$driver) {
            return response()->json(['Driver does not exist!'],422);
        }

        return response()->json($driver);
    }

    /**
     * @OA\Get(
     *      path="/api/auth/driver/getCar",
     *      operationId="getDriverCar",
     *      tags={"Get/Set Car"},
     *      summary="Get car of driver",
     *      description="Get car of driver using driver id",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="Request")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="Driver")
     *       )
     *     )
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
     * @OA\Get(
     *      path="/api/auth/cars",
     *      operationId="getAllCars",
     *      tags={"Cars"},
     *      summary="Get list of cars",
     *      description="Returns list of cars",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#Collection")
     *       )
     *     )
     */
    public function allCars()
    {
        return response()->json($this->service->allCars());
    }

    /**
     * @OA\Post(
     *      path="/api/auth/addCar",
     *      operationId="addCarr",
     *      tags={"Cars"},
     *      summary="Add car",
     *      description="Returns new car",
     *      @OA\Parameter(
     *          name="request",
     *          description="Sended request",
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="AddCarRequest")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(ref="Car")
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="validation failed!",
     *      )
     * )
     */
    public function addCar(AddCarRequest $request): JsonResponse
    {
        return response()->json($this->service->addCar($request));
    }
}
