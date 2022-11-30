<?php

namespace App\Repositories;

use App\Models\Motorcycle;

class MotorcycleRepository {
    protected $motorcycle;

    public function __construct(Motorcycle $motorcycle)
    {
        $this->motorcycle = $motorcycle;
    }

    public function getAll()
    {
        return $this->motorcycle->get();
    }
}