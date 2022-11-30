<?php

namespace App\Repositories;

use App\Models\Vehicle;

class VehicleRepository {
    protected $vehicle;

    public function __construct(Vehicle $vehicle)
    {
        $this->vehicle = $vehicle;
    }

    public function findAll()
    {
        return $this->vehicle->with('motorcycle')->get();
    }

    public function findById($id)
    {
        return $this->vehicle->with('motorcycle')->find($id);
    }

    public function store($data)
    {
        $vehicle = new $this->vehicle;
        $vehicle->warna = $data['warna'];
        $vehicle->tahun = $data['tahun'];
        $vehicle->harga = $data['harga'];
        $vehicle->type = $data['type'];
        $vehicle->stock = $data['stock'];

        $vehicle->save();

        return $vehicle->fresh();
    }
}