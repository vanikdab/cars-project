<?php


namespace App\Http\Services;


use App\Models\Car;
use App\Models\Driver;

class DriverService
{
    protected $model;

    public function __construct()
    {
        $this->model = new Driver;
    }

    public function all()
    {
        return $this->model::all();
    }

    public function withCars()
    {
        return $this->model::with('car')->whereHas('car')->get();
    }

    public function getCar($self)
    {
        $self = $this->model::with('car')->find($self);
        if (!$self) {
            return null;
        }

        return $self;
    }

    public function setCar($request)
    {
        $self = $this->model::find($request->get('driver_id'));
        if (!$self) {
            return null;
        }
        $self->car_id = $request->get('car_id') ;
        $self->save();

        return $self;
    }

    public function addCar($request)
    {
        return Car::query()->create($request->all());
    }
}
