<?php

namespace App\Repositories;

use App\Models\Car;

class CarRepository {
    protected $car;

    public function __construct(Car $car)
    {
        $this->car = $car;
    }

    public function store($data,$vehicleId)
    {
        $car = new $this->car;

        $car->vehicle_id = $vehicleId;
        $car->mesin = $data['mesin'];
        $car->kapasitas_penumpang = $data['kapasitas_penumpang'];
        $car->tipe = $data['tipe'];

        $car->save();

        return $car->fresh();
    }
}