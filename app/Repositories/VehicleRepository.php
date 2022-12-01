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
        return $this->vehicle->with('motorcycle','car')->get();
    }

    public function findById($id)
    {
        return $this->vehicle->with('motorcycle','car')->find($id);
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

    public function delete($id)
    {
        $vehicle = $this->vehicle->find($id);
        $vehicle->delete();
    }

    public function update($id,$data)
    {
        $vehicle = $this->vehicle->find($id);
        $vehicle->update($data);

        return $vehicle->fresh();
    }
}