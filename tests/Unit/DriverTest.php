<?php

namespace Tests\Unit;

use App\Http\Services\DriverService;
use App\Models\Driver;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;

class DriverTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testServiceAll()
    {
        $driverService = new DriverService();

        $this->assertInstanceOf(Collection::class, $driverService->all());
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testServiceGetCar()
    {
        $driverService = new DriverService();

        $id = Driver::first()->id;

        $this->assertInstanceOf(Driver::class, $driverService->getCar($id));
    }
}
