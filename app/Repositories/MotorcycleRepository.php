<?php

namespace App\Repositories;

use App\Models\Motorcycle;

class MotorcycleRepository {
    protected $motorcycle;

    public function __construct(Motorcycle $motorcycle)
    {
        $this->motorcycle = $motorcycle;
    }

    public function store($data,$vehicleId)
    {
        $motorcycle = new $this->motorcycle;

        $motorcycle->vehicle_id = $vehicleId;
        $motorcycle->mesin = $data['mesin'];
        $motorcycle->tipe_suspensi = $data['tipe_suspensi'];
        $motorcycle->tipe_transmisi = $data['tipe_transmisi'];

        $motorcycle->save();

        return $motorcycle->fresh();
    }
}